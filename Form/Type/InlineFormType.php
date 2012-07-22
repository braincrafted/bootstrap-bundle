<?php

namespace Braincrafted\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InlineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', 'email', array(
            'required'      => false,
            'attr'  => array(
                'placeholder'   => 'Email',
                'class'         => 'input-small'
            )
        ));
        $builder->add('password', 'password', array(
            'required'  => false,
            'attr'      => array(
                'placeholder'   => 'Password',
                'class'         => 'input-small'
            )
        ));
        $builder->add('rememberMe', 'checkbox', array(
            'label'     => 'Remember me'
        ));
    }

    public function getName()
    {
        return 'inlineForm';
    }
}