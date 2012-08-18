<?php

namespace Braincrafted\BootstrapBundle  \Voter;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Voter\VoterInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Voter based on the uri
 */
class RequestRegexVoter implements VoterInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

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
     * @param ItemInterface $item
     * @return boolean|null
     */
    public function matchItem(ItemInterface $item)
    {
        $uri = str_replace(array('/', '.'), array('\/', '\.'), $item->getUri());
        if (preg_match('/' . $uri . '/', $this->container->get('request')->getRequestUri())) {
           return true;
        }

        return null;
    }
}
