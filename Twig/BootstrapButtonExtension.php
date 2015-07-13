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
        $o = array_merge($this->buttonDefaults, $options);
        $id = $o['id'] ? "id=\"{$o['id']}\"" : '';
        $class = "class=\"btn btn-{$o['type']} btn-{$o['size']} {$o['class']}\"";
        $buttonType = $o['submit'] ? 'type="submit"' : 'type="button"';
        $icon = $o['icon'] ? $this->iconExtension->iconFunction($o['icon']) : '';
        $title = $o['tooltip'] ? "title=\"{$o['tooltip']}\"" : '';
        $button = "<button $id $class $buttonType $title>{$icon} {$o['label']}</button>";
        return $button;
    }

    /**
     * @param array $options
     * @return string
     */
    public function buttonLinkFunction(array $options = array())
    {
        $o = array_merge($this->buttonLinkDefaults, $options);
        $href = "href=\"{$o['url']}\"";
        $id = $o['id'] ? "id=\"{$o['id']}\"" : '';
        $class = "class=\"btn btn-{$o['type']} btn-{$o['size']} {$o['class']}\"";
        $icon = $o['icon'] ? $this->iconExtension->iconFunction($o['icon']) : '';
        $title = $o['tooltip'] ? "title=\"{$o['tooltip']}\"" : '';
        $button = "<a $id $href $class $title>{$icon} {$o['label']}</a>";
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
