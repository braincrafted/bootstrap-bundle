<?php


namespace Braincrafted\Bundle\BootstrapBundle\Tests\Form\Extension;

use Braincrafted\Bundle\BootstrapBundle\Util\LegacyFormHelper;
use \Mockery as m;
use Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupButtonExtension;
use Symfony\Component\Form\FormView;

class InputGroupButtonExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InputGroupButtonExtension
     */
    private $extension;

    /**
     *
     */
    public function setUp()
    {
        $this->extension = new InputGroupButtonExtension();
    }

    public function testBuildView()
    {

        // map old class to new one using LegacyFormHelper
        $optionsBoth = array(
            'attr' => array(
                'input_group' => array(
                    'button_prepend' => array('name' => 'prepend', 'type' => LegacyFormHelper::getType('submit'), 'options' => array()),
                    'button_append' => array('name' => 'append', 'type' => LegacyFormHelper::getType('submit'), 'options' => array())
                )
            ),
        );


        $buttonPrepend = m::mock('Symfony\Component\Form\Button');
        $buttonPrepend->shouldReceive('createView')->andReturn('prepend');

        $buttonAppend = m::mock('Symfony\Component\Form\Button');
        $buttonAppend->shouldReceive('createView')->andReturn('append');

        $buttonBuilderPrepend = m::mock('Symfony\Component\Form\ButtonBuilder');
        $buttonBuilderPrepend->shouldReceive('getForm')->andReturn($buttonPrepend);

        $buttonBuilderAppend = m::mock('Symfony\Component\Form\ButtonBuilder');
        $buttonBuilderAppend->shouldReceive('getForm')->andReturn($buttonAppend);

        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');
        $builder->shouldReceive('create')->with('prepend', m::any(), m::any())->andReturn($buttonBuilderPrepend);
        $builder->shouldReceive('create')->with('append', m::any(), m::any())->andReturn($buttonBuilderAppend);
        $builder->shouldReceive('getName')->andReturn('input_name');

        $this->extension->buildForm($builder, $optionsBoth);

        $view = new FormView();
        $type = m::mock('Symfony\Component\Form\FormInterface');
        $type->shouldReceive('getName')->andReturn('input_name');

        $this->extension->buildView($view, $type, array());

        $this->assertArrayHasKey('input_group_button_prepend', $view->vars);
        $this->assertArrayHasKey('input_group_button_append', $view->vars);
        $this->assertEquals('prepend', $view->vars['input_group_button_prepend']);
        $this->assertEquals('append', $view->vars['input_group_button_append']);
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupButtonExtension::buildForm()
     * @dataProvider provideForform
     */
    public function testBuildForm($options)
    {
        $button = m::mock('\Symfony\Component\Form\ButtonBuilder');

        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');
        $builder->shouldReceive('getName')->andReturn('input_name');

        // map old class to new one using LegacyFormHelper
        if (isset($options['attr']['input_group']['button_prepend'])) {
            $builder->shouldReceive('create')->with('prepend', LegacyFormHelper::getType('submit'), array())->andReturn($button)->once();
        }

        if (isset($options['attr']['input_group']['button_append'])) {
            $builder->shouldReceive('create')->with('append', LegacyFormHelper::getType('submit'), array())->andReturn($button)->once();
        }

        $this->extension->buildForm($builder, $options);
    }

    public function provideForForm()
    {

        $optionsBoth = array(
            'attr' => array(
                'input_group' => array(
                    'button_prepend' => array('name' => 'prepend', 'type' => LegacyFormHelper::getType('submit'), 'options' => array()),
                    'button_append' => array('name' => 'append', 'type' => LegacyFormHelper::getType('submit'), 'options' => array())
                )
            ),
        );

        $optionsOne = array(
            'attr' => array(
                'input_group' => array(
                    'button_append' => array('name' => 'append', 'type' => LegacyFormHelper::getType('submit'), 'options' => array())
                )
            ),
        );

        $optionsNone = array(
            'attr' => array(
                'input_group' => array(
                )
            ),
        );

        return array(
            array($optionsBoth),
            array($optionsOne),
            array($optionsNone),
            array(array()),
        );
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupButtonExtension::getExtendedType()
     */
    public function testGetExtendedType()
    {
        $this->assertEquals(LegacyFormHelper::getType('text'), $this->extension->getExtendedType());
    }
}
