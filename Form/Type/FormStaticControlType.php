<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 */

namespace Braincrafted\Bundle\BootstrapBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        // map old class to new one using LegacyFormHelper
        return LegacyFormHelper::getType('text');
    }

    /**
     * Backward compatibility for SF < 3.0
     *
     * @return null|string
     */
    public function getName() {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bs_static';
    }
}
