<?php
/**
 * This file is part of BcBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Bc\Bundle\BootstrapBundle\Tests\Twig;

use Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension;

/**
 * BootstrapBadgeExtensionTest
 *
 * @category   Test
 * @package    BcBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 * @group      unit
 */
class BootstrapBadgeExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var BootstrapBadgeExtension */
    private $extension;

    /**
     * Set up
     */
    public function setUp()
    {
        $this->extension = new BootstrapBadgeExtension();
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeFilter
     */
    public function testBadgeFilter()
    {
        $this->assertEquals(
            '<span class="badge">Hello World</span>',
            $this->extension->badgeFilter('Hello World'),
            '->badgeFilter() returns the HTML code for the given badge.'
        );
        $this->assertEquals(
            '<span class="badge badge-success">Hello World</span>',
            $this->extension->badgeFilter('Hello World', 'success'),
            '->badgeFilter() returns the HTML code for the given success badge.'
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeSuccessFilter
     */
    public function testBadgeSuccessFilter()
    {
        $this->assertEquals(
            '<span class="badge badge-success">Foobar</span>',
            $this->extension->badgeSuccessFilter('Foobar')
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeWarningFilter
     */
    public function testBadgeWarningFilter()
    {
        $this->assertEquals(
            '<span class="badge badge-warning">Foobar</span>',
            $this->extension->badgeWarningFilter('Foobar')
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeImportantFilter
     */
    public function testBadgeImportantFilter()
    {
        $this->assertEquals(
            '<span class="badge badge-important">Foobar</span>',
            $this->extension->badgeImportantFilter('Foobar')
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeInfoFilter
     */
    public function testBadgeInfoFilter()
    {
        $this->assertEquals(
            '<span class="badge badge-info">Foobar</span>',
            $this->extension->badgeInfoFilter('Foobar')
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeInverseFilter
     */
    public function testBadgeInverseFilter()
    {
        $this->assertEquals(
            '<span class="badge badge-inverse">Foobar</span>',
            $this->extension->badgeInverseFilter('Foobar')
        );
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::getFilters
     */
    public function testGetFilters()
    {
        $filters = $this->extension->getFilters();
        $this->assertCount(6, $filters, '->getFilters() returns 2 filters.');
        $this->assertTrue(isset($filters['badge']), '->getFilters() returns "badge" filter.');
        $this->assertTrue(isset($filters['badge_success']), '->getFilters() returns "badge_success" filter.');
        $this->assertTrue(isset($filters['badge_warning']), '->getFilters() returns "badge_warning" filter.');
        $this->assertTrue(isset($filters['badge_important']), '->getFilters() returns "badge_important" filter.');
        $this->assertTrue(isset($filters['badge_info']), '->getFilters() returns "badge_info" filter.');
        $this->assertTrue(isset($filters['badge_inverse']), '->getFilters() returns "badge_inverse" filter.');
    }

    /**
     * @covers Bc\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::getName
     */
    public function testGetName()
    {
        $this->assertEquals('bootstrap_badge_extension', $this->extension->getName(), '->getName() returns the name.');
    }
}
