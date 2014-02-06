<?php

namespace Braincrafted\Bundle\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ButtonGroupType
 *
 * Adds support for groups of butttons to be printed in form actions in a single line, not one in each line
 *
 * @package Braincrafted\Bundle\BootstrapBundle\Form\Type
 */
class ButtonGroupType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $buttons = array();
        foreach ($options['buttons'] as $name => $config) {
            $buttons[] = $this->createButton($builder, $name, $config)->getForm();
        }

        $builder->setAttribute('buttons', $buttons);
    }

    /**
     * {@inheritdoc}
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (! $form->getConfig()->hasAttribute('buttons')) {
            return;
        }

        $view->vars['buttons'] = array_map(
            function ($button) use ($view) {
                return $button->createView($view);
            },
            $form->getConfig()->getAttribute('buttons')
        );
    }

    /**
     * Adds a button
     *
     * @param FormBuilderInterface $builder
     * @param array $button
     */
    protected function createButton($builder, $name, $config)
    {
        $options = (isset($config['options']))? $config['options'] : array();
        $button = $builder->create($name, $config['type'], $options);

        if (! $button instanceof ButtonBuilder) {
            throw new \InvalidArgumentException(
                "The ButtonGroupType only accepts buttons, got type '{$config['type']}' for field '$name'"
            );
        }

        return $button;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'buttons'        => array(),
                'options'        => array(),
                'mapped'         => false,
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'button_group';
    }
}
