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

        $fs = new Filesystem();
        $bootstrapLessFile = $this->getContainer()->getParameter('kernel.root_dir') . '/../vendor/twbs/bootstrap/less/bootstrap.less';
        if (false === $fs->exists($bootstrapLessFile)) {
            $output->writeln(
                '<error>Required bundle "twbs/bootstrap" not found in composer.json, please run "composer require twbs/bootstrap && composer update"</error>'
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

        $bootstrapLessFile = $this->getContainer()->getParameter('kernel.root_dir') . '/../vendor/twbs/bootstrap/less/bootstrap.less';
        $content = $this->getCopyrightHeader($output) . "\xA" . file_get_contents($bootstrapLessFile);
        $content = str_replace('@import "', '@import "' . $lessDir, $content);
        $content = str_replace('variables.less";', 'variables.less";' . "\xA" . '@import "' . $variablesFile . '";', $content);

        file_put_contents($config['bootstrap_output'], $content);
    }

    /**
     * Fetches the twbs copyright header from the bootstrap.css file.
     *
     *
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return empty string if unable to fetch header, or the copyright header as string.
     */
    private function getCopyrightHeader(OutputInterface $output) {
        $fs = new Filesystem();
        $copyrightHeaderFile = $this->getContainer()->getParameter('kernel.root_dir') . '/../vendor/twbs/bootstrap/dist/css/bootstrap.css';

        if (false !== $fs->exists($copyrightHeaderFile)) {
            $content = file_get_contents(  $copyrightHeaderFile);
            preg_match_all('/^\/\*!.+copyright.+\*\/$/imsU', $content, $matches);

            if (isset($matches[0][0]))
                return $matches[0][0];
        }

        $output->writeln(
            '<comment>Unable to fetch copyright header from ' .   $copyrightHeaderFile . ', please add it manually.</comment>'
        );

        return '';
    }
}
