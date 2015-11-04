<?php

use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension;
use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension;
use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapFormExtension;
use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension;
use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapLabelExtension;

class Project_Tests_IntegrationTest extends Twig_Test_IntegrationTestCase
{
    public function getExtensions()
    {
        return array(
            new BootstrapBadgeExtension(),
            new BootstrapButtonExtension(new BootstrapIconExtension("fa")),
            new BootstrapFormExtension(),
            new BootstrapIconExtension("fa"),
            new BootstrapLabelExtension(),
        );
    }

    public function getFixturesDir()
    {
        return dirname(__FILE__).'/Fixtures/';
    }
}