<?php

namespace Braincrafted\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

/**
 * Class InputGroupButtonExtension
 *
 * Handles prepended and appended buttons to input fields.
 * Buttons are created and stored during the BuildForm phase and rendered during the buildView Phase.
 *
 * Known issues:
 * - since at build time the form parent is unavailable, two forms with fields of the same name, with buttons attached
 * may cause conflict.
 *
 * @package Braincrafted\Bundle\BootstrapBundle\Form\Extension
 */
class InputGroupButtonExtension extends AbstractTypeExtension
{
    /**
     * @var array
     */
    protected $buttons = array();

    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        if (!isset($this->buttons[$form->getName()])) {
            return;
        }

        $storedButtons = $this->buttons[$form->getName()];

        if (isset($storedButtons['prepend']) && $storedButtons['prepend'] !== null) {
            $view->vars['input_group_button_prepend'] = $storedButtons['prepend']->getForm()->createView();
        }

        if (isset($storedButtons['append']) && $storedButtons['append'] !== null) {
            $view->vars['input_group_button_append'] = $storedButtons['append']->getForm()->createView();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!isset($options['attr']) || !isset($options['attr']['input_group'])) {
            return;
        }

        if (isset($options['attr']['input_group']['button_prepend'])) {
            $this->storeButton(
                $this->addButton(
                    $builder,
                    $options['attr']['input_group']['button_prepend']
                ),
                $builder,
                'prepend'
            );
        }

        if (isset($options['attr']['input_group']['button_append'])) {
            $this->storeButton(
                $this->addButton(
                    $builder,
                    $options['attr']['input_group']['button_append']
                ),
                $builder,
                'append'
            );
        }
    }

    /**
     * Adds a button
     *
     * @param FormBuilderInterface $builder
     * @param array $config
     * @return ButtonBuilder
     */
    protected function addButton(FormBuilderInterface $builder, $config)
    {
        $options = (isset($config['options']))? $config['options'] : array();
        return $builder->create($config['name'], $config['type'], $options);
    }

    /**
     * Stores a button for later rendering
     *
     * @param ButtonBuilder $buttonBuilder
     * @param FormBuilderInterface $form
     * @param string $position
     */
    protected function storeButton(ButtonBuilder $buttonBuilder, FormBuilderInterface $form, $position)
    {
        if (!isset($this->buttons[$form->getName()])) {
            $this->buttons[$form->getName()] = array();
        }

        $this->buttons[$form->getName()][$position] = $buttonBuilder;
    }
}
