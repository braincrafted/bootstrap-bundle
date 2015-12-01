<?php

/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Braincrafted\Bundle\BootstrapBundle\Util\PathUtil;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Kernel;

/**
 * GenerateCommand
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Command
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com BraincraftedBootstrapBundle
 */
class GenerateCommand extends ContainerAwareCommand
{
    const TWBS_BOOTSTRAP_LESS      =   '/../vendor/twbs/bootstrap/less/bootstrap.less';
    const TWBS_COPYRIGHT_HEADER    =   '/../vendor/twbs/bootstrap/dist/css/bootstrap.css';

    /** @var PathUtil */
    private $pathUtil;

    /**
     * {@inheritDoc}
     */
    public function __construct($name = null)
    {
        $this->pathUtil = new PathUtil;

        parent::__construct($name);
    }

    /**
     * {@inheritDoc}
     *
     * @codeCoverageIgnore
     */
    protected function configure()
    {
        $this
            ->setName('braincrafted:bootstrap:generate')
            ->setDescription('Generates a custom bootstrap.less')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = $this->getContainer()->getParameter('braincrafted_bootstrap.customize');

        if (false === isset($config['variables_file']) || null === $config['variables_file']) {
            $output->writeln('<error>Found no custom variables.less file.</error>');

            return;
        }

        $filter = $this->getContainer()->getParameter('braincrafted_bootstrap.less_filter');
        if ('less' !== $filter && 'lessphp' !== $filter) {
            $output->writeln(
                '<error>Bundle must be configured with "less" or "lessphp" to generated bootstrap.less</error>'
            );

            return;
        }

        if (false === (new Filesystem())->exists($this->getContainer()->get('kernel')->getRootDir() . self::TWBS_BOOTSTRAP_LESS)) {
            $output->writeln(
                '<error>Required budle "twbs/bootstrap" not found in composer.json, please run "composer require twbs/bootstrap && composer update"</error>'
            );

            return;
        }

        $output->writeln('<comment>Found custom variables file. Generating...</comment>');
        $this->executeGenerateBootstrap($config, $output);
        $output->writeln(sprintf('Saved to <info>%s</info>', $config['bootstrap_output']));
    }

    protected function executeGenerateBootstrap(array $config, OutputInterface $output)
    {
        // In the template for bootstrap.less we need the path where Bootstraps .less files are stored and the path
        // to the variables.less file.
        // Absolute path do not work in LESSs import statement, we have to calculate the relative ones

        $lessDir = $this->pathUtil->getRelativePath(
                dirname($config['bootstrap_output']),
                $this->getContainer()->getParameter('braincrafted_bootstrap.assets_dir')
            ) . 'less/';

        $variablesDir = $this->pathUtil->getRelativePath(
            dirname($config['bootstrap_output']),
            dirname($config['variables_file'])
        );
        $variablesFile = sprintf(
            '%s%s%s',
            $variablesDir,
            strlen($variablesDir) > 0 ? '/' : '',
            basename($config['variables_file'])
        );

        $container = $this->getContainer();

        if (Kernel::VERSION_ID >= 20500) {
            $container->enterScope('request');
            $container->set('request', new Request(), 'request');
        }

        // Load the content from the original twbs bootstrap.less file
        // and make some modifications and save it to our custom
        // bootstrap less file.

        $content = $this->_getCopyrightHeader($output) . "\xA";
        $content .= file_get_contents($this->getContainer()->get('kernel')->getRootDir() . self::TWBS_BOOTSTRAP_LESS);
        $content = str_replace('@import "', '@import "' . $lessDir, $content);
        $content = str_replace('variables.less";', 'variables.less";' . "\xA" . '@import "' . $variablesFile . '";', $content);

        file_put_contents($config['bootstrap_output'], $content);
    }

    private function _getCopyrightHeader(OutputInterface $output) {
        $copyrightFile = $this->getContainer()->get('kernel')->getRootDir() . self::TWBS_COPYRIGHT_HEADER;
        $content = file_get_contents($copyrightFile);
        preg_match_all('/^\/\*!.+copyright.+\*\/$/imsU', $content, $matches);

        if (!isset($matches[0][0])) {
            $output->writeln(
                '<comment>Unable to fetch copyright header from ' . $copyrightFile . ', please add it manually.</comment>'
            );

            return;
        }

        return $matches[0][0];
    }
}
