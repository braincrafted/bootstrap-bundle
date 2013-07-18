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
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'bootstrap_form';
    }
}
