<?php

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Form\Extension;

use \Mockery as m;

use Braincrafted\Bundle\BootstrapBundle\Form\Extension\TypeSetterExtension;
use Braincrafted\Bundle\BootstrapBundle\Util\LegacyFormHelper;

/**
 * TypeSetterExtensionTest
 *
 * @group unit
 */
class TypeSetterExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var TypeSetterExtension */
    private $extension;

    public function setUp()
    {
        $this->extension = new TypeSetterExtension;
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\TypeSetterExtension::buildView()
     */
    public function testBuildView()
    {
        $view = m::mock('Symfony\Component\Form\FormView');
        $type = m::mock('Symfony\Component\Form\ResolvedFormTypeInterface');
        if(LegacyFormHelper::isLegacy()) {
            $type->shouldReceive('getName')->andReturn('form');
        } else {
            $type->shouldReceive('getBlockPrefix')->andReturn(LegacyFormHelper::getType('form'));
        }
        $config = m::mock('Symfony\Component\Form\FormConfigInterface');
        $config->shouldReceive('getType')->andReturn($type);
        $form = m::mock('Symfony\Component\Form\FormInterface');
        $form->shouldReceive('getConfig')->andReturn($config);

        $this->extension->buildView($view, $form, array());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\TypeSetterExtension::getExtendedType()
     */
    public function testGetExtendedType()
    {
        // map old class to new one using LegacyFormHelper
        $this->assertEquals(LegacyFormHelper::getType('form'), $this->extension->getExtendedType());
    }
}
