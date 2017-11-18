<?php

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Type;

use \Mockery as m;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType;
use Braincrafted\Bundle\BootstrapBundle\Util\LegacyFormHelper;

/**
 * MoneyTypeTest
 *
 * @group unit
 */
class MoneyTypeTest extends \PHPUnit\Framework\TestCase
{
    /** @var MoneyType */
    private $type;

    public function setUp()
    {
        $this->type = new MoneyType;
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::buildView()
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::getPattern()
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::parsePatternMatches()
     */
    public function testBuildViewLeftSide()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $form = m::mock('Symfony\Component\Form\FormInterface');

        $this->type->buildView($view, $form, array('currency' => 'EUR'));
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::buildView()
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::getPattern()
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::parsePatternMatches()
     */
    public function testBuildViewRightSide()
    {
        /*
         * If the intl extension is not loaded this will throw an test error,
         * even with the symfony provided intl component, as this php replacement
         * layer can only handle 'en':
         * http://symfony.com/doc/current/components/intl.html
         */
        if(extension_loaded('intl')) {
            $view = m::mock('Symfony\Component\Form\FormView');
            $form = m::mock('Symfony\Component\Form\FormInterface');

            $default = \Locale::getDefault();
            \Locale::setDefault('fr-CA');
            $this->type->buildView($view, $form, array('currency' => 'EUR'));
            \Locale::setDefault($default);
        }
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::buildView()
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::getPattern()
     */
    public function testGetPatternEmpty()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $form = m::mock('Symfony\Component\Form\FormInterface');

        $this->type->buildView($view, $form, array('currency' => null));
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\MoneyType::getBlockPrefix()
     */
    public function testGetBlockPrefix()
    {
        $this->assertEquals('money', $this->type->getBlockPrefix());
    }
}
