<?php

namespace Bc\Bundle\BootstrapBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class TypeSetterExtension extends AbstractTypeExtension
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['original_type'] = $form->getConfig()->getType()->getName();
    }

    public function getExtendedType()
    {
        return "form";
    }
}
