<?php

/**
 * This file is part of Bootstrap for Symfony2.
 * Copyright 2012 Florian Eckerstorfer
 */

namespace Braincrafted\BootstrapBundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;

/**
 * BootstrapLabelExtension
 *
 * @category   TwigExtension
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapBadgeExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'badge'          => new Twig_Filter_Method($this, 'badgeFilter', array('is_safe' => array('html'))),
            'badge_success'  => new Twig_Filter_Method($this, 'badgeSuccessFilter', array('is_safe' => array('html'))),
            'badge_warning'  => new Twig_Filter_Method($this, 'badgeWarningFilter', array('is_safe' => array('html'))),
            'badge_important'=> new Twig_Filter_Method($this, 'badgeImportantFilter', array('is_safe' => array('html'))),
            'badge_info'     => new Twig_Filter_Method($this, 'badgeInfoFilter', array('is_safe' => array('html'))),
            'badge_inverse'  => new Twig_Filter_Method($this, 'badgeInverseFilter', array('is_safe' => array('html')))
        );
    }

    /**
     * Returns the HTML code for a badge
     *
     * @param string $text  The text of the badge
     * @param string $type  The type of badge
     *
     * @return string The HTML code with the icons
     */
    public function badgeFilter($text, $type = null)
    {
        return sprintf('<span class="badge%s">%s</span>', ($type ? ' badge-' . $type : ''), $text);
    }

    public function badgeSuccessFilter($text)
    {
        return $this->badgeFilter($text, 'success');
    }

    public function badgeWarningFilter($text)
    {
        return $this->badgeFilter($text, 'warning');
    }

    public function badgeImportantFilter($text)
    {
        return $this->badgeFilter($text, 'important');
    }

    public function badgeInfoFilter($text)
    {
        return $this->badgeFilter($text, 'info');
    }

    public function badgeInverseFilter($text)
    {
        return $this->badgeFilter($text, 'inverse');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bootstrap_badge_extension';
    }
}