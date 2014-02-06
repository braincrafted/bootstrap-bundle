<?php


namespace Braincrafted\Bundle\BootstrapBundle\Tests\Type;

use Braincrafted\Bundle\BootstrapBundle\Form\Type\ButtonGroupType;
use Mockery as m;
use Symfony\Component\Form\ButtonBuilder;
use Symfony\Component\Form\FormBuilder;

/**
 * Class ButtonGroupTypeTest
 *
 * @group unit
 */
class ButtonGroupTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ButtonGroupType
     */
    protected $type;

    protected function setUp()
    {
        parent::setUp();
        $this->type = new ButtonGroupType();
    }

    public function testBuildForm()
    {
        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');

        $input  = array(
            'buttons' => [
                'save' => ['type' => 'submit', 'options' => ['label' => 'button.save']],
                'cancel' => ['type' => 'button', 'options' => ['label' => 'button.cancel']],
            ]
        );

        $buttonBuilder = new ButtonBuilder('name');
        $builder->shouldReceive('create')
            ->with(m::anyOf('save', 'cancel'), m::anyOf('submit', 'button'), m::hasKey('label'))
            ->twice()
            ->andReturn($buttonBuilder);

        $builder->shouldReceive('setAttribute')
            ->with('buttons', m::hasValue($buttonBuilder->getForm()))
            ->once();

        $this->type = new ButtonGroupType();
        $this->type->buildForm($builder, $input);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFormWithNotButton()
    {
        $builder = m::mock('Symfony\Component\Form\FormBuilderInterface');

        $input  = array(
            'buttons' => [
                'save' => ['type' => 'text', 'options' => ['label' => 'button.save']],
                'cancel' => ['type' => 'text', 'options' => ['label' => 'button.save']],
            ]
        );

        $builder = new FormBuilder(
            'name',
            '',
            m::mock('Symfony\Component\EventDispatcher\EventDispatcher'),
            m::mock('Symfony\Component\Form\FormFactoryInterface')
        );

        $builder->shouldReceive('create')
            ->with('save', 'text', m::any())
            ->once()
            ->andReturn($builder);

        $builder->shouldReceive('setAttribute')->never();

        $this->type = new ButtonGroupType();
        $this->type->buildForm($builder, $input);
    }

    public function testBuildView()
    {
        $view    = m::mock('Symfony\Component\Form\FormView');
        $form    = m::mock('Symfony\Component\Form\FormInterface');
        $config  = m::mock('Symfony\Component\Form\FormConfigInterface');
        $button = m::mock('Symfony\Component\Form\Button');
        $options = array();

        $buttons = array(
            $button,
            $button
        );

        $form->shouldReceive('getConfig')->andReturn($config);

        $config->shouldReceive('hasAttribute')->with('buttons')->andReturn(true)->once();
        $config->shouldReceive('getAttribute')->with('buttons')->andReturn($buttons)->once();

        $button->shouldReceive('createView')->with($view)->andReturn($view);

        $this->type = new ButtonGroupType();
        $this->type->buildView($view, $form, $options);

        $this->assertArrayHasKey('buttons', $view->vars);
    }

    public function testSetDefaultOptions()
    {

        $defaults = array(
            'buttons'        => array(),
            'options'        => array(),
            'mapped'         => false,
        );

        $resolver = m::mock('Symfony\Component\OptionsResolver\OptionsResolverInterface');
        $resolver->shouldReceive('setDefaults')->with($defaults)->once();

        $this->type->setDefaultOptions($resolver);
    }

    public function testGetName()
    {
        $this->assertEquals('button_group', $this->type->getName());
    }
}
