<?php

namespace Dukevomv\LaravelTrials\Tests;

use Dukevomv\LaravelTrials\LaravelTrialsServiceProvider;
use Orchestra\Testbench\TestCase;

class MainTestCase extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom([
                                    '--realpath' => true,
                                    '--path'     => realpath(__DIR__.'/../database/migrations'),
                                  ]);
    }

    protected function getPackageProviders($app): array
    {
        return [
          LaravelTrialsServiceProvider::class,
        ];
    }

    public function defineEnvironment($app)
    {
        self::initializeConfig($app);
        $app['config']->set('laravel-trials.enabled', true);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
                                                           'driver'                  => 'sqlite',
                                                           'database'                => ':memory:',
                                                           'prefix'                  => '',
                                                           'foreign_key_constraints' => true,
                                                         ]
        );
    }


    private static function initializeConfig($app)
    {
        foreach (require __DIR__.'/../config/config.php' as $key => $item) {
            self::setConfigOfKey($app, $key, $item);
        }
    }

    private static function setConfigOfKey($app, $key, $main)
    {
        if (!is_array($main)) {
            $app['config']->set('laravel-trials.'.$key, $main);
        } else {
            foreach ($main as $subkey => $item) {
                self::setConfigOfKey($app, $key.'.'.$subkey, $item);
            }
        }
    }

}