<?php

namespace Braincrafted\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class InputGroupBtnExtension extends AbstractTypeExtension
{
    /**
     * @var ButtonBuilder
     */
    protected $prependedButtonBuilder;

    /**
     * @var ButtonBuilder
     */
    protected $appendedButtonBuilder;

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
        if ($this->prependedButtonBuilder !== null) {
            $view->vars['input_group_btn_prepend'] = $this->prependedButtonBuilder->getForm()->createView();
        }

        if ($this->appendedButtonBuilder !== null) {
            $view->vars['input_group_btn_append'] = $this->appendedButtonBuilder->getForm()->createView();
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

        if (isset($options['attr']['input_group']['btn_prepend'])) {
            $this->prependedButtonBuilder = $this->addButton($builder, $options['attr']['input_group']['btn_prepend']);
        }


        if (isset($options['attr']['input_group']['btn_append'])) {
            $this->appendedButtonBuilder = $this->addButton($builder, $options['attr']['input_group']['btn_append']);
        }

    }

    /**
     * Adds a button
     *
     * @param FormBuilderInterface $builder
     * @param array $config
     * @return ButtonBuilder
     */
    protected function addButton($builder, $config)
    {
        $options = (isset($config['options']))? $config['options'] : array();
        return $builder->create($config['name'], $config['type'], $options);
    }
}
