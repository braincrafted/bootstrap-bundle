<?php

namespace Braincrafted\Bundle\BootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * InstallCommand
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Command
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com BraincraftedBootst
 */
class InstallCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName('braincrafted:bootstrap:install')
            ->setDescription('Installs the icon font');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $destDir = $this->getDestDir();

        $finder = new Finder;
        $fs = new Filesystem;

        try {
            $fs->mkdir($destDir);
        } catch (IOException $e) {
            $output->writeln(sprintf('<error>Could not create directory %s.</error>', $destDir));

            return;
        }

        $srcDir = $this->getSrcDir();
        if (false === file_exists($srcDir)) {
            $output->writeln(sprintf(
                '<error>Fonts directory "%s" does not exist. Did you install twbs/bootstrap? '.
                'If you used something other than Composer you need to manually change the path in '.
                '"braincrafted_bootstrap.assets_dir". If you want to use Font Awesome you need to install the font and change the option "braincrafted_bootstrap.fontawesome_dir".</error>',
                $srcDir
            ));

            return;
        }
        $finder->files()->in($srcDir);

        foreach ($finder as $file) {
            $dest = sprintf('%s/%s', $destDir, $file->getBaseName());
            try {
                $fs->copy($file, $dest);
            } catch (IOException $e) {
                $output->writeln(sprintf('<error>Could not copy %s</error>', $file->getBaseName()));

                return;
            }
        }

        $output->writeln(sprintf('Copied icon fonts to <comment>%s</comment>.', $destDir));
    }

    /**
     * @return string
     */
    protected function getSrcDir()
    {
        if ('fa' === $this->getContainer()->getParameter('braincrafted_bootstrap.icon_prefix')) {
            return sprintf('%s/fonts', $this->getContainer()->getParameter('braincrafted_bootstrap.fontawesome_dir'));
        }

        return sprintf(
            '%s/%s',
            $this->getContainer()->getParameter('braincrafted_bootstrap.assets_dir'),
            (
                // Sass version stores fonts in a different directory
                in_array($this->getContainer()->getParameter('braincrafted_bootstrap.css_preprocessor'), array('sass', 'scssphp')) ?
                'fonts/bootstrap' :
                'fonts'
            )
        );
    }

    /**
     * @return string
     */
    protected function getDestDir()
    {
        return $this->getContainer()->getParameter('braincrafted_bootstrap.fonts_dir');
    }
}
