<?php

namespace Braincrafted\BootstrapBundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;

class BootstrapIconExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            'icon' => new Twig_Filter_Method($this, 'iconFilter'),
        );
    }

    public function iconFilter($text, $default = false)
    {
        return preg_replace_callback(
            '/\.icon-([a-z0-9-]+)/',
            function ($matches) use ($default) {
                return sprintf('<i class="%sicon-%s"></i>', $default ? 'icon-white ' : '', $matches[1]);
            },
            $text
        );
    }

    public function getName()
    {
        return 'bootstrap_icon_extension';
    }
}