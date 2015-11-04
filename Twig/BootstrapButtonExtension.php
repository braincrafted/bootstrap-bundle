<?php

/**
 * @author Damian Dlugosz <d.dlugosz@bestnetwork.it>
 */

namespace Braincrafted\Bundle\BootstrapBundle\Twig;

use Twig_Extension;
use Twig_SimpleFunction;

class BootstrapButtonExtension extends Twig_Extension
{
    /**
     * @var BootstrapIconExtension
     */
    private $iconExtension;

    private $defaults = array(
        'label'     => '',
        'icon'      => false,
        'type'      => 'default',
        'size'      => 'md',
        'attr'      => array(),
    );

    /**
     * @param BootstrapIconExtension $iconExtension
     */
    public function __construct(BootstrapIconExtension $iconExtension)
    {
        $this->iconExtension = $iconExtension;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('button', array($this, 'buttonFunction'), array('is_safe' => array('html'))),
            new Twig_SimpleFunction('button_link', array($this, 'buttonLinkFunction'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonFunction(array $options = array())
    {
        $options = array_merge($this->defaults, $options);

        $options['attr']['class'] = "btn btn-{$options['type']} btn-{$options['size']}" . (isset($options['attr']['class']) ? ' '.$options['attr']['class'] : '');
        $options['attr']['type'] = isset($options['submit']) && $options['submit'] ? 'submit' : 'button';

        $icon       = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']).' ' : '';
        $attr       = $options['attr'] ? $this->attributes($options['attr']) : '';

        $button     = "<button{$attr}>{$icon}{$options['label']}</button>";

        return $button;
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonLinkFunction(array $options = array())
    {
        $options = array_merge($this->defaults, $options);

        $options['attr']['class'] = "btn btn-{$options['type']} btn-{$options['size']}" . (isset($options['attr']['class']) ? ' '.$options['attr']['class'] : '');
        $options['attr']['href'] = (isset($options['url']) ? $options['url'] : '#');

        $icon   = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']).' ' : '';
        $attr   = $options['attr'] ? $this->attributes($options['attr']) : '';

        $button = "<a{$attr}>{$icon}{$options['label']}</a>";

        return $button;
    }

    private function attributes(array $attributes)
    {
        $result = '';
        array_walk($attributes, function($value, $attr) use (&$result) {
            $result .= " $attr=\"$value\"";
        });
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'braincrafted_bootstrap_button';
    }
}
