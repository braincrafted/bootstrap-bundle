<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Twig;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

/**
 * BootstrapIconExtension
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapIconExtension extends Twig_Extension
{
    /**
     * @var string
     */
    private $iconPrefix;

    /**
     * @var string
     */
    private $iconTag;

    /**
     * @param string $iconPrefix
     * @param string $iconTag
     */
    public function __construct($iconPrefix, $iconTag = 'span')
    {
        $this->iconPrefix = $iconPrefix;
        $this->iconTag = $iconTag;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            new Twig_SimpleFilter(
                'parse_icons',
                array($this, 'parseIconsFilter'),
                array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction(
                'icon',
                array($this, 'iconFunction'),
                array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }

    /**
     * Parses the given string and replaces all occurrences of .icon-[name] with the corresponding icon.
     *
     * @param string $text The text to parse
     *
     * @return string The HTML code with the icons
     */
    public function parseIconsFilter($text)
    {
        $that = $this;

        return preg_replace_callback(
            '/\.([a-z]+)-([a-z0-9+-]+)/',
            function ($matches) use ($that) {
                return $that->iconFunction($matches[2], $matches[1]);
            },
            $text
        );
    }

    /**
     * Returns the HTML code for the given icon.
     *
     * @param string $icon The name of the icon
     * @param string $iconSet The icon-set name
     *
     * @return string The HTML code for the icon
     */
    public function iconFunction($icon, $iconSet = 'icon')
    {
        if ($iconSet == 'icon') $iconSet = $this->iconPrefix;
        $icon = str_replace('+', ' '.$iconSet.'-', $icon);

        return sprintf('<%1$s class="%2$s %2$s-%3$s"></%1$s>', $this->iconTag, $iconSet, $icon);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'braincrafted_bootstrap_icon';
    }
}
