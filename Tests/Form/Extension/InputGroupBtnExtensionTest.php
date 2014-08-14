<?php


namespace Braincrafted\Bundle\BootstrapBundle\Tests\Form\Extension;

use \Mockery as m;
use Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupBtnExtension;
use Symfony\Component\Form\FormView;

class InputGroupBtnExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var InputGroupBtnExtension
     */
    private $extension;

    /**
     *
     */
    public function setUp()
    {
        $this->extension = new InputGroupBtnExtension();
    }

    public function testBuildView()
    {
        $optionsBoth = array(
            'attr' => array(
                'input_group' => array(
                    'btn_prepend' => array('name' => 'prepend', 'type' => 'submit', 'options' => array()),
                    'btn_append' => array('name' => 'append', 'type' => 'submit', 'options' => array())
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

        $this->extension->buildForm($builder, $optionsBoth);

        $view = new FormView();
        $type = m::mock('Symfony\Component\Form\FormInterface');

        $this->extension->buildView($view, $type, array());

        $this->assertArrayHasKey('input_group_btn_prepend', $view->vars);
        $this->assertArrayHasKey('input_group_btn_append', $view->vars);
        $this->assertEquals('prepend', $view->vars['input_group_btn_prepend']);
        $this->assertEquals('append', $view->vars['input_group_btn_append']);
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupBtnExtension::buildForm()
     * @dataProvider provideForform
     */
    public function testBuildForm($options)
    {
        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');

        if (isset($options['attr']['input_group']['btn_prepend'])) {
            $builder->shouldReceive('create')->with('prepend', 'submit', array())->once();
        }

        if (isset($options['attr']['input_group']['btn_append'])) {
            $builder->shouldReceive('create')->with('append', 'submit', array())->once();
        }

        $this->extension->buildForm($builder, $options);
    }

    public function provideForForm()
    {
        $optionsBoth = array(
            'attr' => array(
                'input_group' => array(
                    'btn_prepend' => array('name' => 'prepend', 'type' => 'submit', 'options' => array()),
                    'btn_append' => array('name' => 'append', 'type' => 'submit', 'options' => array())
                )
            ),
        );

        $optionsOne = array(
            'attr' => array(
                'input_group' => array(
                    'btn_append' => array('name' => 'append', 'type' => 'submit', 'options' => array())
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
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Extension\InputGroupBtnExtension::getExtendedType()
     */
    public function testGetExtendedType()
    {
        $this->assertEquals('text', $this->extension->getExtendedType());
    }
}
