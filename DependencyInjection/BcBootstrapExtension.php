<?php
/**
 * This file is part of braincrafted/bootstrap-bundle
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
 * @package    braincrafted/bootstrap-bundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BcBootstrapExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

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

        // Configure TwigBundle
        if (isset($bundles['TwigBundle'])) {
            $this->configureTwigBundle($bundles, $container);
        }

        // Configure KnpMenuBundle
        if (isset($bundles['TwigBundle']) && isset($bundles['KnpMenuBundle'])) {
            $this->configureKnpMenuBundle($bundles, $container);
        }

        if (isset($bundles['TwigBundle']) && isset($bundles['KnpPaginatorBundle'])) {
            $this->configureKnpPaginatorBundle($bundles, $container);
        }
    }

    /**
     * Configures the TwigBundle.
     *
     * @param array            $bundles   The list of loaded bundles
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureTwigBundle(array $bundles, ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'twig':
                    $container->prependExtensionConfig($name, array(
                        'form'  => array(
                            'resources' => array('BcBootstrapBundle:Form:form_div_layout.html.twig')
                        )
                    ));
                    break;
            }
        }
    }

    /**
     * Configures the KnpMenuBundle.
     *
     * @param array            $bundles   The list of loaded bundles
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureKnpMenuBundle(array $bundles, ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'knp_menu':
                    $container->prependExtensionConfig($name, array(
                        'twig'  => array(
                            'template'  => 'BcBootstrapBundle:Menu:menu.html.twig'
                        )
                    ));
                    break;
            }
        }
    }

    /**
     * Configures the KnpPaginatorBundle.
     *
     * @param array            $bundles   The list of loaded bundles
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    protected function configureKnpPaginatorBundle(array $bundles, ContainerBuilder $container)
    {
        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'knp_paginator':
                    $container->prependExtensionConfig($name, array(
                        'template' => array(
                            'pagination' => 'BcBootstrapBundle:Pagination:pagination.html.twig'
                        )
                    ));
                    break;
            }
        }
    }
}
