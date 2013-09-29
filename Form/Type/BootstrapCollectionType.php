<?php
/**
 * This file is part of BcBootstrapBundle.
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Bc\Bundle\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\EventListener\ResizeFormListener;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * MoneyType
 *
 * @package    BcBootstrapBundle
 * @subpackage Form
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class BootstrapCollectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace(
            $view->vars,
            array(
                'allow_add'          => $options['allow_add'],
                'allow_delete'       => $options['allow_delete'],
                'add_button_text'    => $options['add_button_text'],
                'delete_button_text' => $options['delete_button_text'],
                'widget_col'         => $options['widget_col'],
                'button_col'         => $options['button_col']
            )
        );

        if ($form->getConfig()->hasAttribute('prototype')) {
            $view->vars['prototype'] = $form->getConfig()->getAttribute('prototype')->createView($view);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $optionsNormalizer = function (Options $options, $value) {
            $value['block_name'] = 'entry';

            return $value;
        };

        $resolver->setDefaults(array(
            'allow_add'          => false,
            'allow_delete'       => false,
            'prototype'          => true,
            'prototype_name'     => '__name__',
            'type'               => 'text',
            'add_button_text'    => 'Add',
            'delete_button_text' => 'Delete',
            'widget_col'         => 10,
            'button_col'         => 2,
            'options'            => array(),
        ));

        $resolver->setNormalizers(array('options' => $optionsNormalizer));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'collection';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'bc_collection';
    }
}
