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
class BootstrapLabelExtension extends Twig_Extension
{
    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return array(
            'label'          => new Twig_Filter_Method($this, 'labelFilter', array('is_safe' => array('html'))),
            'label_success'  => new Twig_Filter_Method($this, 'labelSuccessFilter', array('is_safe' => array('html'))),
            'label_warning'  => new Twig_Filter_Method($this, 'labelWarningFilter', array('is_safe' => array('html'))),
            'label_important'=> new Twig_Filter_Method($this, 'labelImportantFilter', array('is_safe' => array('html'))),
            'label_info'     => new Twig_Filter_Method($this, 'labelInfoFilter', array('is_safe' => array('html'))),
            'label_inverse'  => new Twig_Filter_Method($this, 'labelInverseFilter', array('is_safe' => array('html')))
        );
    }

    /**
     * Returns the HTML code for a label
     *
     * @param string $text  The text of the label
     * @param string $type  The type of label
     *
     * @return string The HTML code with the icons
     */
    public function labelFilter($text, $type = null)
    {
        return sprintf('<span class="label%s">%s</span>', ($type ? ' label-' . $type : ''), $text);
    }

    public function labelSuccessFilter($text)
    {
        return $this->labelFilter($text, 'success');
    }

    public function labelWarningFilter($text)
    {
        return $this->labelFilter($text, 'warning');
    }

    public function labelImportantFilter($text)
    {
        return $this->labelFilter($text, 'important');
    }

    public function labelInfoFilter($text)
    {
        return $this->labelFilter($text, 'info');
    }

    public function labelInverseFilter($text)
    {
        return $this->labelFilter($text, 'inverse');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bootstrap_label_extension';
    }
}