<?php

namespace Bc\Bundle\BootstrapBundle\Twig;

use Symfony\Bridge\Twig\TokenParser\FormThemeTokenParser;
use Symfony\Bridge\Twig\Form\TwigRendererInterface;
use Symfony\Component\Form\Extension\Core\View\ChoiceView;

/**
 * BootstrapFormExtension extends Twig with form capabilities.
 *
 * @author Florian Eckerstorfer <florian@eckerstorfer.co>
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
            new \Twig_SimpleFunction('bootstrap_set_style', [$this, 'setStyle']),
            new \Twig_SimpleFunction('bootstrap_get_style', [$this, 'getStyle']),
            'checkbox_row'  => new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html'))),
            'radio_row'  => new \Twig_Function_Node('Symfony\Bridge\Twig\Node\SearchAndRenderBlockNode', array('is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'bootstrap_form';
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function getStyle()
    {
        return $this->style;
    }
}
