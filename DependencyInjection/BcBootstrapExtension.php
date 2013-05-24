<?php
/**
 * This file is part of BcBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Bc\Bundle\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * BcBootstrapExtension
 *
 * @package    BcBootstrapBundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 *
 * @codeCoverageIgnore
 */
class BcBootstrapExtension extends Extension implements PrependExtensionInterface
{
    /** @var string */
    private $formTemplate = 'BcBootstrapBundle:Form:form_div_layout.html.twig';

    /** @var string */
    private $menuTemplate = 'BcBootstrapBundle:Menu:menu.html.twig';

    /** @var string */
    private $paginationTemplate = 'BcBootstrapBundle:Pagination:pagination.html.twig';

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        // Configure Assetic if AsseticBundle is activated and the option
        // "bc_bootstrap.auto_configure.assetic" is set to TRUE (default value).
        if (isset($bundles['AsseticBundle']) && $config['auto_configure']['assetic']) {
            $this->configureAsseticBundle($container, $config);
        }

        // Configure Twig if TwigBundle is activated and the option
        // "bc_bootstrap.auto_configure.twig" is set to TRUE (default value).
        if (isset($bundles['TwigBundle']) && $config['auto_configure']['twig']) {
            $this->configureTwigBundle($container);
        }

        // Configure KnpMenu if KnpMenuBundle and TwigBundle are activated and the option
        // "bc_bootstrap.auto_configure.knp_menu" is set to TRUE (default value).
        if (isset($bundles['TwigBundle']) && isset($bundles['KnpMenuBundle']) && $config['auto_configure']['knp_menu']) {
            $this->configureKnpMenuBundle($container);
        }

        // Configure KnpPaginiator if KnpPaginatorBundle and TwigBundle are activated and the option
        // "bc_bootstrap.auto_configure.knp_paginator" is set to TRUE (default value).
        if (isset($bundles['TwigBundle']) && isset($bundles['KnpPaginatorBundle']) && $config['auto_configure']['knp_paginator']) {
            $this->configureKnpPaginatorBundle($container);
        }
    }

    /**
     * Configures the AsseticBundle.
     *
     * @param ContainerBuilder $container The service container
     * @param array            $config    The bundle configuration
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function configureAsseticBundle(ContainerBuilder $container, array $config)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'assetic':
                    $container->prependExtensionConfig(
                        $name,
                        array(
                            'assets'    => $this->buildAsseticConfig($config)
                        )
                    );
                    break;
            }
        }
    }

    /**
     * Configures the TwigBundle.
     *
     * @param ContainerBuilder $container The service container
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function configureTwigBundle(ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'twig':
                    $container->prependExtensionConfig(
                        $name,
                        array('form'  => array('resources' => array($this->formTemplate)))
                    );
                    break;
            }
        }
    }

    /**
     * Configures the KnpMenuBundle.
     *
     * @param ContainerBuilder $container The service container
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function configureKnpMenuBundle(ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'knp_menu':
                    $container->prependExtensionConfig(
                        $name,
                        array('twig' => array('template'  => $this->menuTemplate))
                    );
                    break;
            }
        }
    }

    /**
     * Configures the KnpPaginatorBundle.
     *
     * @param ContainerBuilder $container The service container
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function configureKnpPaginatorBundle(ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'knp_paginator':
                    $container->prependExtensionConfig(
                        $name,
                        array('template' => array('pagination' => $this->paginationTemplate))
                    );
                    break;
            }
        }
    }

    private function buildAsseticConfig(array $config)
    {
        $output = array();
        if ($config['less_filter'] !== 'none') {
            $output['bootstrap_css'] = $this->buildAsseticBootstrapCssWithLessConfig($config);
        } else {
            $output['bootstrap_css'] = $this->buildAsseticBootstrapCssWithoutLessConfig($config);
        }
        $output['bootstrap_js'] = $this->buildAsseticBootstrapJsConfig($config);
        $output['jquery'] = $this->buildAsseticJqueryConfig($config);
        return $output;
    }

    private function buildAsseticBootstrapCssWithoutLessConfig(array $config)
    {
        $inputs = array(
            $config['assets_dir'].'/docs/assets/css/bootstrap.css',
        );

        if ($config['include_responsive'] === true) {
            $inputs[] = $config['assets_dir'].'/docs/assets/css/bootstrap-responsive.css';
        }

        return array(
            'inputs'        => $inputs,
            'filters'       => array('cssrewrite'),
            'output'        => $config['output_dir'].'/css/bootstrap.css'
        );
    }

    private function buildAsseticBootstrapCssWithLessConfig(array $config)
    {
        $inputs = array(
            $config['assets_dir'].'/less/bootstrap.less'
        );

        if ($config['include_responsive'] === true) {
            $inputs[] = $config['assets_dir'].'/less/responsive.less';
        }

        $inputs[] = __DIR__.'/../Resources/less/form.less';

        return array(
            'inputs'        => $inputs,
            'filters'       => array($config['less_filter'], 'cssrewrite'),
            'output'        => $config['output_dir'].'/css/bootstrap.css'
        );
    }

    private function buildAsseticBootstrapJsConfig(array $config)
    {
        return array(
            'inputs'        => array(
                $config['assets_dir'].'/js/bootstrap-transition.js',
                $config['assets_dir'].'/js/bootstrap-alert.js',
                $config['assets_dir'].'/js/bootstrap-button.js',
                $config['assets_dir'].'/js/bootstrap-carousel.js',
                $config['assets_dir'].'/js/bootstrap-collapse.js',
                $config['assets_dir'].'/js/bootstrap-dropdown.js',
                $config['assets_dir'].'/js/bootstrap-modal.js',
                $config['assets_dir'].'/js/bootstrap-tooltip.js',
                $config['assets_dir'].'/js/bootstrap-popover.js',
                $config['assets_dir'].'/js/bootstrap-scrollspy.js',
                $config['assets_dir'].'/js/bootstrap-tab.js',
                $config['assets_dir'].'/js/bootstrap-typeahead.js',
                $config['assets_dir'].'/js/bootstrap-affix.js',
                __DIR__.'/../Resources/js/bc-bootstrap-collection.js'
            ),
            'output'        => $config['output_dir'].'/js/bootstrap.js'
        );
    }

    private function buildAsseticJqueryConfig(array $config)
    {
        return array(
            'inputs'        => array($config['jquery_path']),
            'output'        => $config['output_dir'].'/js/jquery.js'
        );
    }
}
