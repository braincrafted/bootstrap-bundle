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

        $id         = $options['id'] ? "id=\"{$options['id']}\"" : '';
        $class      = "class=\"btn btn-{$options['type']} btn-{$options['size']} {$options['class']}\"";
        $buttonType = $options['submit'] ? 'type="submit"' : 'type="button"';
        $icon       = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']) : '';
        $title      = $options['tooltip'] ? "title=\"{$options['tooltip']}\"" : '';
        $button     = "<button $id $class $buttonType $title>{$icon} {$options['label']}</button>";

        return $button;
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonLinkFunction(array $options = array())
    {
        $options = array_merge($this->buttonLinkDefaults, $options);

        $href   = "href=\"{$options['url']}\"";
        $id     = $options['id'] ? "id=\"{$options['id']}\"" : '';
        $class  = "class=\"btn btn-{$options['type']} btn-{$options['size']} {$options['class']}\"";
        $icon   = $options['icon'] ? $this->iconExtension->iconFunction($options['icon']) : '';
        $title  = $options['tooltip'] ? "title=\"{$options['tooltip']}\"" : '';
        $button = "<a $id $href $class $title>{$icon} {$options['label']}</a>";

        return $button;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'braincrafted_bootstrap_button';
    }
}
