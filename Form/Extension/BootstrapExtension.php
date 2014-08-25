<?php

/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

/**
 * BootstrapExtension
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Form
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @author     André Püschel <pue@der-pue.de>
 * @copyright  2014 Florian Eckerstorfer <florian@eckerstorfer.co>
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapExtension extends AbstractTypeExtension
{
    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['bootstrap'] = $form->getConfig()->getOption('bootstrap');
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['bootstrap' => [
            'form_style'        => null,
            'widget_col'        => 10,
            'label_col'         => 2,
            'col_size'          => 'lg',
            'simple_col'        => false,
            'inline'            => false,
            'align_with_widget' => true,
            'icon'              => null,
            'input_group'       => null,
            'help_text'         => null,
        ]]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return 'form';
    }
}