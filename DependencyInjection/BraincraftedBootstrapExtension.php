<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Braincrafted\Bundle\BootstrapBundle\DependencyInjection\AsseticConfiguration;

/**
 * BraincraftedBootstrapExtension
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BraincraftedBootstrapExtension extends Extension implements PrependExtensionInterface
{
    /** @var string */
    protected $formTemplate = 'BraincraftedBootstrapBundle:Form:bootstrap.html.twig';

    /** @var string */
    protected $menuTemplate = 'BraincraftedBootstrapBundle:Menu:bootstrap.html.twig';

    /** @var string */
    protected $paginationTemplate = 'BraincraftedBootstrapBundle:Pagination:bootstrap.html.twig';

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processSassConfiguration(
            $this->processConfiguration($configuration, $configs)
        );

        $loader = new Loader\XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services/form.xml');
        $loader->load('services/twig.xml');
        $loader->load('services/session.xml');

        if (true === isset($config['customize'])) {
            $container->setParameter('braincrafted_bootstrap.customize', $config['customize']);
        }
        $container->setParameter('braincrafted_bootstrap.assets_dir', $config['assets_dir']);
        $container->setParameter('braincrafted_bootstrap.fontawesome_dir', $config['fontawesome_dir']);
        $container->setParameter('braincrafted_bootstrap.fonts_dir', $config['fonts_dir']);
        $container->setParameter('braincrafted_bootstrap.output_dir', $config['output_dir']);

        // changed from css_preprocessor to css_preprocessor for 3.0
        $container->setParameter('braincrafted_bootstrap.css_preprocessor', $config['css_preprocessor']);
        $container->setParameter('braincrafted_bootstrap.icon_prefix', $config['icon_prefix']);
        $container->setParameter('braincrafted_bootstrap.icon_tag', $config['icon_tag']);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processSassConfiguration(
            $this->processConfiguration(new Configuration(), $configs)
        );

        // Configure Assetic if AsseticBundle is activated and the option
        // "braincrafted_bootstrap.auto_configure.assetic" is set to TRUE (default value).
        if (true === isset($bundles['AsseticBundle']) && true === $config['auto_configure']['assetic']) {
            $this->configureAsseticBundle($container, $config);
        }

        // Configure Twig if TwigBundle is activated and the option
        // "braincrafted_bootstrap.auto_configure.twig" is set to TRUE (default value).
        if (true === isset($bundles['TwigBundle']) && true === $config['auto_configure']['twig']) {
            $this->configureTwigBundle($container);
        }

        // Configure KnpMenu if KnpMenuBundle and TwigBundle are activated and the option
        // "braincrafted_bootstrap.auto_configure.knp_menu" is set to TRUE (default value).
        if (true === isset($bundles['TwigBundle']) &&
            true === isset($bundles['KnpMenuBundle']) &&
            true === $config['auto_configure']['knp_menu']) {
            $this->configureKnpMenuBundle($container);
        }

        // Configure KnpPaginiator if KnpPaginatorBundle and TwigBundle are activated and the option
        // "braincrafted_bootstrap.auto_configure.knp_paginator" is set to TRUE (default value).
        if (true === isset($bundles['TwigBundle']) &&
            true === isset($bundles['KnpPaginatorBundle']) &&
            true === $config['auto_configure']['knp_paginator']) {
            $this->configureKnpPaginatorBundle($container);
        }
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function processSassConfiguration(array $config)
    {
        // changed from css_preprocessor to css_preprocessor for 3.0
        if (in_array($config['css_preprocessor'], array('sass', 'scssphp'))) {
            if ($config['assets_dir'] === Configuration::DEFAULT_ASSETS_DIR) {
                $config['assets_dir'] = Configuration::DEFAULT_ASSETS_DIR_SASS;
            }
            if ($config['customize']['bootstrap_output'] === Configuration::DEFAULT_BOOTSTRAP_OUTPUT) {
                $config['customize']['bootstrap_output'] = Configuration::DEFAULT_BOOTSTRAP_OUTPUT_SASS;
            }
            if ($config['customize']['bootstrap_template'] === Configuration::DEFAULT_BOOTSTRAP_TEMPLATE) {
                $config['customize']['bootstrap_template'] = Configuration::DEFAULT_BOOTSTRAP_TEMPLATE_SASS;
            }
        }

        return $config;
    }

    /**
     * @param ContainerBuilder $container The service container
     * @param array            $config    The bundle configuration
     *
     * @return void
     */
    protected function configureAsseticBundle(ContainerBuilder $container, array $config)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'assetic':
                    $asseticConfig = new AsseticConfiguration;
                    $container->prependExtensionConfig(
                        $name,
                        array('assets' => $asseticConfig->build($config))
                    );
                    break;
            }
        }
    }

    /**
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureTwigBundle(ContainerBuilder $container)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
            switch ($name) {
                case 'twig':
                    $container->prependExtensionConfig(
                        $name,
                        array('form_themes'  => array($this->formTemplate))
                    );
                    break;
            }
        }
    }

    /**
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureKnpMenuBundle(ContainerBuilder $container)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
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
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureKnpPaginatorBundle(ContainerBuilder $container)
    {
        foreach (array_keys($container->getExtensions()) as $name) {
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
}
