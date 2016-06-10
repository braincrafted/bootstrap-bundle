<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2013 Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Braincrafted\Bundle\BootstrapBundle\Composer;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\PhpExecutableFinder;
use Composer\Script\Event;

/**
 * ScriptHandler
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage Composer
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 *
 * @codeCoverageIgnore
 */
class ScriptHandler
{
    /**
     * @param CommandEvent $event
     */
    public static function install(Event $event)
    {
        $options = self::getOptions($event);
        $consolePathOptionsKey = array_key_exists('symfony-bin-dir', $options) ? 'symfony-bin-dir' : 'symfony-app-dir';
        $consolePath = $options[$consolePathOptionsKey];

        if (!is_dir($consolePath)) {
            printf(
                'The %s (%s) specified in composer.json was not found in %s, can not build bootstrap '.
                'file.%s',
                $consolePathOptionsKey,
                $consolePath,
                getcwd(),
                PHP_EOL
            );

            return;
        }

        static::executeCommand($event, $consolePath, 'braincrafted:bootstrap:install', $options['process-timeout']);
    }

    protected static function executeCommand(Event $event, $consolePath, $cmd, $timeout = 300)
    {
        $php = escapeshellarg(self::getPhp(false));
        $console = escapeshellarg($consolePath.'/console');
        if ($event->getIO()->isDecorated()) {
            $console .= ' --ansi';
        }

        $process = new Process($php.' '.$console.' '.$cmd, null, null, null, $timeout);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
        if (!$process->isSuccessful()) {
            throw new \RuntimeException(
                sprintf('An error occurred when executing the "%s" command.', escapeshellarg($cmd))
            );
        }
    }

    protected static function getOptions(Event $event)
    {
        $options = array_merge(array(
            'symfony-app-dir' => 'app',
            'symfony-web-dir' => 'web',
            'symfony-assets-install' => 'hard'
        ), $event->getComposer()->getPackage()->getExtra());

        $options['symfony-assets-install'] = getenv('SYMFONY_ASSETS_INSTALL') ?: $options['symfony-assets-install'];

        $options['process-timeout'] = $event->getComposer()->getConfig()->get('process-timeout');

        return $options;
    }

    protected static function getPhp($includeArgs = true)
    {
        $phpFinder = new PhpExecutableFinder;
        if (!$phpPath = $phpFinder->find($includeArgs)) {
            throw new \RuntimeException(
                'The php executable could not be found, add it to your PATH environment variable and try again'
            );
        }

        return $phpPath;
    }
}
