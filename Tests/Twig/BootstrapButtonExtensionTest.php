<?php

/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Twig;

use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension;
use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension;

/**
 * BootstrapBadgeExtensionTest
 *
 * This test is only useful if you consider that it will be run by Travis on every supported PHP
 * configuration. We live in a world where should not have too manually test every commit with every
 * version of PHP. And I know exactly that I will commit short array syntax all the time and break
 * compatibility with PHP 5.3
 *
 * @category   Test
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 * @group      unit
 */
class BootstrapButtonExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var BootstrapButtonExtension */
    private $extension;

    /**
     * Set up
     */
    public function setUp()
    {
        $iconExtension = new BootstrapIconExtension('fa', 'i');
        $this->extension = new BootstrapButtonExtension($iconExtension);
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(2, $this->extension->getFunctions());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::buttonFunction
     */
    public function testButtonFunctionWithDefaults()
    {
        $this->assertEquals(
            '<button class="btn btn-default btn-md" type="button"></button>',
            $this->extension->buttonFunction(),
            '->buttonFunction() returns the HTML code for the given button.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::buttonFunction
     */
    public function testButtonFunctionWithOptions()
    {
        $options = array(
            'label'     => 'Test',
            'icon'      => 'check',
            'type'      => 'success',
            'size'      => 'sm',
            'submit'    => true,
            'attr'      => array(
                'id'            => 'test_button',
                'class'         => 'my-class',
                'title'         => 'Test',
                'data-confirm'  => 'Are you sure?'
            ),
        );

        $this->assertEquals(
            '<button id="test_button" class="btn btn-success btn-sm my-class" title="Test" data-confirm="Are you sure?" type="submit"><i class="fa fa-check"></i> Test</button>',
            $this->extension->buttonFunction($options),
            '->buttonFunction() returns the HTML code for the given button.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::buttonLinkFunction
     */
    public function testButtonLinkFunctionWithDefaults()
    {
        $this->assertEquals(
            '<a class="btn btn-default btn-md" href="#"></a>',
            $this->extension->buttonLinkFunction(),
            '->buttonFunction() returns the HTML code for the given button.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::buttonLinkFunction
     */
    public function testButtonLinkFunctionWithOptions()
    {
        $options = array(
            'label'     => 'Test',
            'icon'      => 'check',
            'url'       => 'example.com',
            'type'      => 'success',
            'size'      => 'sm',
            'attr'      => array(
                'id'            => 'test_button',
                'class'         => 'my-class',
                'title'         => 'Test',
                'data-confirm'  => 'Are you sure?'
            ),
        );

        $this->assertEquals(
            '<a id="test_button" class="btn btn-success btn-sm my-class" title="Test" data-confirm="Are you sure?" href="example.com"><i class="fa fa-check"></i> Test</a>',
            $this->extension->buttonLinkFunction($options),
            '->buttonFunction() returns the HTML code for the given button.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapButtonExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('braincrafted_bootstrap_button', $this->extension->getName());
    }
}
