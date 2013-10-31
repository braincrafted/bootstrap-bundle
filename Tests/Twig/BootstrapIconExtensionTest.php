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
    /** @var BootstrapIconExtension */
    private $extension;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->extension = new BootstrapIconExtension();
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::iconFunction
     */
    public function testIconFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span>',
            $this->extension->iconFunction('heart'),
            '->iconFunction() returns the HTML code for the given icon.'
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapIconExtension::parseIconsFilter
     */
    public function testParseIconsFilter()
    {
        $this->assertEquals(
            '<span class="glyphicon glyphicon-heart"></span> foobar',
            $this->extension->parseIconsFilter('.icon-heart foobar'),
            '->parseIconsFilter() returns the HTML code with the replaced icons.'
        );
    }
}
