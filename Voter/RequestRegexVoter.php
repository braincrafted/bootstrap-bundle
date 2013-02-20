<?php

/**
 * This file is part of Bootstrap for Symfony2.
 * Copyright 2012 Florian Eckerstorfer
 */

namespace Braincrafted\BootstrapBundle\Voter;

use Knp\Menu\ItemInterface;
use Braincrafted\BootstrapBundle\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * RequestRegexVoter
 *
 * @category   Voter
 * @package    BraincraftedBootstrapBundle
 * @subpackage Voter
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class RequestRegexVoter implements VoterInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container The container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Checks whether an item is current.
     *
     * If the voter is not able to determine a result,
     * it should return null to let other voters do the job.
     *
     * @param \Knp\Menu\ItemInterface $item The item
     *
     * @return boolean|null
     */
    public function matchItem(ItemInterface $item)
    {
        $uri = str_replace(array('/', '.'), array('\/', '\.'), $item->getUri());
        if (preg_match('/' . $uri . '/', $this->container->get('request')->getRequestUri())) {
           return true;
        }

        return false;
    }
}
