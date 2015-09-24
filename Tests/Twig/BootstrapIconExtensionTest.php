<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Twig;

use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension;

/**
 * BootstrapIconExtensionTest
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
class BootstrapIconExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::getFilters()
     */
    public function testGetFilters()
    {
        $this->assertCount(1, $this->getIconExtension()->getFilters());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $this->assertCount(1, $this->getIconExtension()->getFunctions());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::iconFunction
     */
    public function testIconFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span>',
            $this->getIconExtension('glyphicon')->iconFunction('heart'),
            '->iconFunction() returns the HTML code for the given icon.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span>',
            $this->getIconExtension('fa')->iconFunction('heart'),
            '->iconFunction() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::iconFunction
     */
    public function testIconFilterWithDifferntPrefix()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span>',
            $this->getIconExtension('default')->iconFunction('heart', 'glyphicon'),
            '->iconFunction() returns the HTML code for the given icon.'
        );
        $this->assertEquals(
            '<span class="fa fa-heart"></span>',
            $this->getIconExtension('default')->iconFunction('heart', 'fa'),
            '->iconFunction() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::parseIconsFilter
     */
    public function testParseIconsFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span> foobar',
            $this->getIconExtension('glyphicon')->parseIconsFilter('.icon-heart foobar'),
            '->parseIconsFilter() returns the HTML code with the replaced icons.'
        );

        $this->assertEquals(
            '<span class="fa fa-heart"></span> foobar',
            $this->getIconExtension('fa')->parseIconsFilter('.icon-heart foobar'),
            '->parseIconsFilter() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::parseIconsFilter
     */
    public function testParseIconsFilterWithDifferntPrefix()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span> foobar',
            $this->getIconExtension('default')->parseIconsFilter('.glyphicon-heart foobar'),
            '->parseIconsFilter() returns the HTML code with the replaced icons.'
        );

        $this->assertEquals(
            '<span class="fa fa-heart"></span> foobar',
            $this->getIconExtension('default')->parseIconsFilter('.fa-heart foobar'),
            '->parseIconsFilter() uses the iconPrefix passed into the IconExtension constructor.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals('braincrafted_bootstrap_icon', $this->getIconExtension()->getName());
    }

    private function getIconExtension($iconPrefix = null)
    {
        return new BootstrapIconExtension($iconPrefix);
    }
}
