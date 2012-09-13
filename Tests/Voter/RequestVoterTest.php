<?php

/**
 * This file is part of Bootstrap for Symfony2.
 * Copyright 2012 Florian Eckerstorfer
 */

namespace Braincrafted\BootstrapBundle\Tests\Voter;

use Braincrafted\BootstrapBundle\Voter\RequestVoter;

/**
 * RequestVoterTest
 *
 * @category   Test
 * @package    BraincraftedBootstrapBundle
 * @subpackage Voter
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class RequestVoterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Braincrafted\BootstrapBundle\Voter\RequestVoter::__construct
     * @covers Braincrafted\BootstrapBundle\Voter\RequestVoter::matchItem
     */
    public function testMatchItem_True()
    {
        $item = $this->getMock('Knp\Menu\ItemInterface');
        $item->expects($this->once())
            ->method('getUri')
            ->will($this->returnValue('/demo-uri'));

        $this->assertTrue($this->getVoter()->matchItem($item), '->matchItem() returns TRUE if the URLs match.');
    }

    /**
     * @covers Braincrafted\BootstrapBundle\Voter\RequestVoter::__construct
     * @covers Braincrafted\BootstrapBundle\Voter\RequestVoter::matchItem
     */
    public function testMatchItem_False()
    {
        $item = $this->getMock('Knp\Menu\ItemInterface');
        $item->expects($this->once())
            ->method('getUri')
            ->will($this->returnValue('/other-uri'));

        $this->assertFalse($this->getVoter()->matchItem($item), '->matchItem() returns FALSE if the URLs don\'t match.');
    }

    protected function getVoter()
    {
        $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $request->expects($this->once())
            ->method('getRequestUri')
            ->will($this->returnValue('/demo-uri'));
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('get')
            ->with($this->equalTo('request'))
            ->will($this->returnValue($request));

        return new RequestVoter($container);
    }
}