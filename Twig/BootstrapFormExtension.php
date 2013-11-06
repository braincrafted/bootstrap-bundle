<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Twig;

/**
 * BootstrapFormExtension
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Twig
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapFormExtension extends \Twig_Extension
{
    /** @var string */
    private $style;

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('bootstrap_set_style', array($this, 'setStyle')),
            new \Twig_SimpleFunction('bootstrap_get_style', array($this, 'getStyle')),
            'checkbox_row'  => new \Twig_Function_Node(
                'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode',
                array('is_safe' => array('html'))
            ),
            'radio_row'  => new \Twig_Function_Node(
                'Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode',
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'braincrafted_bootstrap_form';
    }

    /**
     * Sets the style.
     *
     * @param string $style Name of the style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * Returns the style.
     *
     * @return string Name of the style
     */
    public function getStyle()
    {
        return $this->style;
    }
}
