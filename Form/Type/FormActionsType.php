<?php

namespace Braincrafted\Bundle\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class FormActionsType
 *
 * Adds support for form actions, printing buttons in a single line, and correctly offset.
 *
 * @package Braincrafted\Bundle\BootstrapBundle\Form\Type
 *
 * @author Rafael Dohms <code@doh.ms>
 */
class FormActionsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach ($options['buttons'] as $name => $config) {
            $this->addButton($builder, $name, $config)->getForm();
        }
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
        if ($form->count() == 0) {
            return;
        }

        $invalidFields = array_filter($form->all(), [$this, 'validateButton']);

        if (count($invalidFields) !== $form->count()) {
            throw new \InvalidArgumentException("Children of FormActionsType must be instances of the Button class");
        }
    }

    /**
     * Adds a button
     *
     * @param FormBuilderInterface $builder
     * @param $name
     * @param $config
     * @throws \InvalidArgumentException
     * @return ButtonBuilder
     */
    protected function createButton($builder, $name, $config)
    {
        $options = (isset($config['options']))? $config['options'] : array();
        $button = $builder->add($name, $config['type'], $options);

        if (! $button instanceof ButtonBuilder) {
            throw new \InvalidArgumentException(
                "The FormActionsType only accepts buttons, got type '{$config['type']}' for field '$name'"
            );
        }

        return $button;
    }

    /**
     * Validates if child is a Button
     *
     * @param FormInterface $field
     * @return bool
     */
    protected function validateButton(FormInterface $field)
    {
        return ($field instanceof Button);
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
        return 'form_actions';
    }
}
