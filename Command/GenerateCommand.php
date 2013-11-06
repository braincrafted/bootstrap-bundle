<?php

namespace Braincrafted\Bundle\BootstrapBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
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
        $config = $this->getContainer()->getParameter('braincrafted_bootstrap.customize_variables');

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

        $output->writeln('<comment>Found custom variables file. Generating...</comment>');
        $this->executeGenerateBootstrap($config);
        $output->writeln(sprintf('Saved to <info>%s</info>', $config['bootstrap_output']));
    }

    protected function executeGenerateBootstrap(array $config)
    {
        // In the template for bootstrap.less we need the path where Bootstraps .less files are stored and the path
        // to the variables.less file.
        // Absolute path do not work in LESSs import statement, we have to calculate the relative ones

        $lessDir = $this->getRelativePath(
            dirname($config['bootstrap_output']),
            $this->getContainer()->getParameter('braincrafted_bootstrap.assets_dir')
        );
        $variablesDir = $this->getRelativePath(
            dirname($config['bootstrap_output']),
            dirname($config['variables_file'])
        );
        $variablesFile = sprintf(
            '%s%s%s',
            $variablesDir,
            strlen($variablesDir) > 0 ? '/' : '',
            basename($config['variables_file'])
        );

        // We can now use Twig to render the bootstrap.less file and save it
        $content = $this->getContainer()->get('twig')->render(
            $config['bootstrap_template'],
            array(
                'variables_file' => $variablesFile,
                'assets_dir'     => $lessDir
            )
        );
        file_put_contents($config['bootstrap_output'], $content);
    }

    /**
     * Returns the relative path $from to $to.
     *
     * @param string $from
     * @param string $to
     *
     * @return string
     *
     * @link http://stackoverflow.com/a/2638272/776654
     */
    protected function getRelativePath($from, $to)
    {
         // some compatibility fixes for Windows paths
        $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
        $to   = is_dir($to)   ? rtrim($to, '\/') . '/'   : $to;
        $from = str_replace('\\', '/', $from);
        $to   = str_replace('\\', '/', $to);

        $from     = explode('/', $from);
        $to       = explode('/', $to);
        $relPath  = $to;

        foreach($from as $depth => $dir) {
            // find first non-matching dir
            if($dir === $to[$depth]) {
                // ignore this directory
                array_shift($relPath);
            } else {
                // get number of remaining dirs to $from
                $remaining = count($from) - $depth;
                if($remaining > 1) {
                    // add traversals up to first matching dir
                    $padLength = (count($relPath) + $remaining - 1) * -1;
                    $relPath = array_pad($relPath, $padLength, '..');
                    break;
                } else {
                    $relPath[0] = './' . $relPath[0];
                }
            }
        }
        return implode('/', $relPath);
    }
}
