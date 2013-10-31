<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Twig;

use Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension;

/**
 * BootstrapBadgeExtensionTest
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
     * @covers Braincrafted\Bundle\BootstrapBundle\Twig\BootstrapBadgeExtension::badgeFunction
     */
    public function testBadgeFunction()
    {
        $this->assertEquals(
            '<span class="badge">Hello World</span>',
            $this->extension->badgeFunction('Hello World'),
            '->badgeFunction() returns the HTML code for the given badge.'
        );
    }
}
