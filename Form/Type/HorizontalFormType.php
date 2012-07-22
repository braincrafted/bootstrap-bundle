<?php

namespace Braincrafted\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HorizontalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('textInput', 'text', array(
            'label'     => 'Text input',
            'required'  => false,
            'attr'      => array(
                'class'         => 'input-xlarge'
            )
        ));
        $builder->add('checkbox', 'checkbox', array(
            'label'     => 'Option one is this and that—be sure to include why it\'s great',
            'required'  => false,
            'attr'      => array(
                'class'         => 'input-small'
            )
        ));
        $builder->add('selectList', 'choice', array(
            'label'     => 'Select list',
            'required'  => false,
            'data'      => 0,
            'choices'   => array('something', '2', '3', '4', '5')
        ));
        $builder->add('multiconSelect', 'choice', array(
            'label'     => 'Multicon-select',
            'required'  => false,
            'multiple'  => true,
            'choices'   => array('1', '2', '3', '4', '5')
        ));
        $builder->add('fileInput', 'file', array(
            'label'     => 'File input',
            'required'  => false
        ));
        $builder->add('textarea', 'textarea', array(
            'label'     => 'Textarea',
            'required'  => false,
            'attr'      => array(
                'class'         => 'input-xlarge',
                'rows'          => 3
            )
        ));
    }

    public function getName()
    {
        return 'horizontalForm';
    }
}