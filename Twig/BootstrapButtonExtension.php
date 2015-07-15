<?php

/**
 * @author Damian Dlugosz <d.dlugosz@bestnetwork.it>
 */

namespace Braincrafted\Bundle\BootstrapBundle\Twig;

class BootstrapButtonExtension extends \Twig_Extension
{
    /**
     * @var BootstrapIconExtension
     */
    private $iconExtension;

    private $buttonDefaults = array(
        'id'        => null,
        'label'     => '',
        'tooltip'   => '',
        'class'     => '',
        'icon'      => false,
        'type'      => 'default',
        'size'      => 'md',
        'submit'    => true,
        'attr'      => array(),
    );

    private $buttonLinkDefaults = array(
        'id'        => null,
        'url'       => '#',
        'label'     => '',
        'tooltip'   => '',
        'class'     => '',
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
            new \Twig_SimpleFunction('button', array($this, 'buttonFunction'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('button_link', array($this, 'buttonLinkFunction'), array('is_safe' => array('html'))),
        );
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonFunction(array $options = array())
    {
        $options = array_merge($this->buttonDefaults, $options);

        if ($options['class']) {
            $options['class'] = ' '.$options['class'];
        }

        $id         = $options['id'] ? " id=\"{$options['id']}\"" : '';
        $class      = " class=\"btn btn-{$options['type']} btn-{$options['size']}{$options['class']}\"";
        $buttonType = $options['submit'] ? ' type="submit"' : ' type="button"';
        $title      = $options['tooltip'] ? " title=\"{$options['tooltip']}\"" : '';
        $icon       = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']).' ' : '';
        $attr       = $options['attr'] ? $this->attributes($options['attr']) : '';

        $button     = "<button{$id}{$class}{$buttonType}{$title}{$attr}>{$icon}{$options['label']}</button>";

        return $button;
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonLinkFunction(array $options = array())
    {
        $options = array_merge($this->buttonLinkDefaults, $options);

        if ($options['class']) {
            $options['class'] = ' '.$options['class'];
        }

        $href   = " href=\"{$options['url']}\"";
        $id     = $options['id'] ? " id=\"{$options['id']}\"" : '';
        $class  = " class=\"btn btn-{$options['type']} btn-{$options['size']}{$options['class']}\"";
        $icon   = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']).' ' : '';
        $title  = $options['tooltip'] ? " title=\"{$options['tooltip']}\"" : '';
        $attr   = $options['attr'] ? $this->attributes($options['attr']) : '';

        $button = "<a{$id}{$href}{$class}{$title}{$attr}>{$icon}{$options['label']}</a>";

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
