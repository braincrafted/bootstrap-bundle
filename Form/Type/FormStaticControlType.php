<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 */

namespace Braincrafted\Bundle\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * FormStaticControlType
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Form
 * @author     André Püschel <pue@der-pue.de>
 * @copyright  2014 André Püschel
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 */
class FormStaticControlType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //'mapped'         => false,
            'required'       => false,
            'disabled'      => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'bs_static';
    }
}
