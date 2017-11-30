<?php

/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\Tests\Command;

use \Mockery as m;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;

use Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand;

/**
 * InstallCommandTest
 *
 * @category   Test
 * @package    BraincraftedBootstrapBundle
 * @subpackage Command
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com BraincraftedBootstrapBundle
 * @group      unit
 */
class InstallCommandTest extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->container = m::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->container->shouldReceive('hasParameter')->andReturn(false);

        $this->kernel = m::mock('Symfony\Component\HttpKernel\KernelInterface');
        $this->kernel->shouldReceive('getName')->andReturn('app');
        $this->kernel->shouldReceive('getEnvironment')->andReturn('prod');
        $this->kernel->shouldReceive('isDebug')->andReturn(false);
        $this->kernel->shouldReceive('getContainer')->andReturn($this->container);
        $this->kernel->shouldReceive('boot');
        $this->kernel->shouldReceive('getBundles')->andReturn(array());
    }

    public function tearDown()
    {
        $file = sprintf('%s/fixtures/web/fonts/font1.txt', __DIR__);
        if (true === file_exists($file)) {
            unlink($file);
        }
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::execute()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getSrcDir()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getDestDir()
     */
    public function testExecute()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.assets_dir')
            ->andReturn(__DIR__.'/fixtures/vendor/twbs/bootstrap');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.icon_prefix')
            ->andReturn('glyphicon');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.css_preprocessor')
            ->andReturn('');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fonts_dir')
            ->andReturn(__DIR__.'/fixtures/web/fonts');

        $this->container->shouldReceive('has');

        // mock the Kernel or create one depending on your needs
        $application = new Application($this->kernel);
        $application->add(new InstallCommand());

        $command = $application->find('braincrafted:bootstrap:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/Copied icon fonts/', $commandTester->getDisplay());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::execute()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getSrcDir()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getDestDir()
     */
    public function testExecuteFontAwesome()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fonts_dir')
            ->andReturn(__DIR__.'/fixtures/web/fonts');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.icon_prefix')
            ->andReturn('fa');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fontawesome_dir')
            ->andReturn(__DIR__.'/fixtures/vendor/twbs/bootstrap');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.css_preprocessor')
            ->andReturn('');

        $this->container->shouldReceive('has');

        // mock the Kernel or create one depending on your needs
        $application = new Application($this->kernel);
        $application->add(new InstallCommand());

        $command = $application->find('braincrafted:bootstrap:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/Copied icon fonts/', $commandTester->getDisplay());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::execute()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getSrcDir()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getDestDir()
     */
    public function testExecuteSrcNotExists()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.assets_dir')
            ->andReturn(__DIR__.'/invalid');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fonts_dir')
            ->andReturn(__DIR__.'/fixtures/web/fonts');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.icon_prefix')
            ->andReturn('glyphicon');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.css_preprocessor')
            ->andReturn('');

        $this->container->shouldReceive('has');

        // mock the Kernel or create one depending on your needs
        $application = new Application($this->kernel);
        $application->add(new InstallCommand());

        $command = $application->find('braincrafted:bootstrap:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/does not exist/', $commandTester->getDisplay());
    }

    /**
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::execute()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getSrcDir()
     * @covers Braincrafted\Bundle\BootstrapBundle\Command\InstallCommand::getDestDir()
     */
    public function testExecuteInvalidDestDirectory()
    {
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fonts_dir')
            ->andReturn('/../fonts');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.icon_prefix')
            ->andReturn('glyphicon');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.css_preprocessor')
            ->andReturn('');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.assets_dir')
            ->andReturn('');
        $this->container
            ->shouldReceive('getParameter')
            ->with('braincrafted_bootstrap.fontawesome_dir')
            ->andReturn('');

        $this->container->shouldReceive('has');

        // mock the Kernel or create one depending on your needs
        $application = new Application($this->kernel);
        $application->add(new InstallCommand());

        $command = $application->find('braincrafted:bootstrap:install');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertRegExp('/Could not create directory/', $commandTester->getDisplay());
    }
}
