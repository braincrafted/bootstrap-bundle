<?php

namespace Braincrafted\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BasicFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('labelName', 'text', array(
            'label'         => 'Label name',
            'required'      => false,
            'attr'  => array(
                'placeholder'   => 'Type something...',
                'class'         => 'span3'
            )
        ));
        $builder->add('checkMeOut', 'checkbox', array(
            'label'     => 'Check me out'
        ));
    }

    public function getName()
    {
        return 'basicForm';
    }
}