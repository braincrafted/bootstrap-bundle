<?php


namespace Braincrafted\Bundle\BootstrapBundle\Tests\Type;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\FormActionsType;
use Mockery as m;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\FormBuilder;

use Braincrafted\Bundle\BootstrapBundle\Util\LegacyFormHelper;

/**
 * Class FormActionsTypeTest
 *
 * @group unit
 */
class FormActionsTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormActionsType
     */
    protected $type;

    protected function setUp()
    {
        parent::setUp();
        $this->type = new FormActionsType();
    }

    public function testBuildForm()
    {
        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');

        // map old class to new one using LegacyFormHelper
        $input = array(
            'buttons' => array(
                'save' => array('type' => LegacyFormHelper::getType('submit'), 'options' => array('label' => 'button.save')),
                'cancel' => array('type' => LegacyFormHelper::getType('button'), 'options' => array('label' => 'button.cancel')),
            )
        );


        $buttonBuilder = new ButtonBuilder('name');
        $builder->shouldReceive('add')
            ->with(m::anyOf('save', 'cancel'), m::anyOf(LegacyFormHelper::getType('submit'), LegacyFormHelper::getType('button')), m::hasKey('label'))
            ->twice()
            ->andReturn($buttonBuilder);

        $this->type = new FormActionsType();
        $this->type->buildForm($builder, $input);
    }

    public function testBuildView()
    {
        $view    = m::mock('Symfony\Component\Form\FormView');
        $form    = m::mock('Symfony\Component\Form\FormInterface');
        $button  = m::mock('Symfony\Component\Form\Button');
        $options = array();

        $buttons = array(
            $button,
            $button
        );

        $form->shouldReceive('count')->andReturn(2)->once();
        $form->shouldReceive('all')->andReturn($buttons)->once();

        $this->type = new FormActionsType();
        $this->type->buildView($view, $form, $options);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildViewWithBadField()
    {
        $view    = m::mock('Symfony\Component\Form\FormView');
        $form    = m::mock('Symfony\Component\Form\FormInterface');
        $button  = m::mock('Symfony\Component\Form\Button');
        $input   = m::mock('Symfony\Component\Form\FormInterface');
        $options = array();

        $buttons = array(
            $button,
            $button,
            $input
        );

        $form->shouldReceive('count')->andReturn(2)->once();
        $form->shouldReceive('all')->andReturn($buttons)->once();

        $this->type = new FormActionsType();
        $this->type->buildView($view, $form, $options);
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\FormActionsType::configureOptions()
     */
    public function testConfigureOptions()
    {

        $defaults = array(
            'buttons'        => array(),
            'options'        => array(),
            'mapped'         => false,
        );

        $resolver = m::mock('Symfony\Component\OptionsResolver\OptionsResolver');
        $resolver->shouldReceive('setDefaults')->with($defaults)->once();

        $this->type->configureOptions($resolver);
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Form\Type\FormActionsType::getBlockPrefix()
     */
    public function testGetBlockPrefix()
    {
        $this->assertEquals('form_actions', $this->type->getName());
    }
}
