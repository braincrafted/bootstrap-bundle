<?php
namespace Braincrafted\Bundle\BootstrapBundle\Util;

/**
 * Special thanks to the authors of FOSUserBundle on which this Util is based on.
 *
 * @internal
 *
 * @author Adrian Gorny <lashus@gmail.com>
 */
final class LegacyFormHelper
{
    private static $map = array(
        'form' => 'Symfony\Component\Form\Extension\Core\Type\FormType',
        'email' => 'Symfony\Component\Form\Extension\Core\Type\EmailType',
        'text' => 'Symfony\Component\Form\Extension\Core\Type\TextType',
        'submit' => 'Symfony\Component\Form\Extension\Core\Type\SubmitType',
        'button' => 'Symfony\Component\Form\Extension\Core\Type\ButtonType',
        'collection' => 'Symfony\Component\Form\Extension\Core\Type\CollectionType'
    );

    public static function getType($class)
    {
        if (self::isLegacy()) {
            return $class;
        }

        if (!isset(self::$map[$class])) {
            throw new \InvalidArgumentException(sprintf('Form type with class "%s" can not be found. Please check for typos or add it to the map in LegacyFormHelper', $class));
        }

        return self::$map[$class];
    }

    public static function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }
}
