<?php

namespace Braincrafted\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchQuery', 'text', array(
            'required'      => false,
            'attr'  => array(
                'class'         => 'input-medium search-query'
            )
        ));
    }

    public function getName()
    {
        return 'searchForm';
    }
}