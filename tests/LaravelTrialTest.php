<?php

namespace Dukevomv\LaravelTrials\Tests;


use Carbon\Carbon;
use Dukevomv\LaravelTrials\LaravelTrials;
use Illuminate\Support\Facades\Session;

class LaravelTrialTest extends MainTestCase
{
    /** @test */
    public function generateNameFromEmail_works(){
        $this->assertEquals('Dukevomv',LaravelTrials::generateNameFromEmail('dukevomv@gmail.com'));
    }

    /** @test */
    public function generateNameFromEmail_works_without_at(){
        $this->assertEquals('Dukevomv.gmail.com',LaravelTrials::generateNameFromEmail('dukevomv.gmail.com'));
    }

    /** @test */
    public function generateEmailForRole_works(){
        $timestamp = Carbon::now()->timestamp;
        $this->assertEquals('user+'.$timestamp.'@example.com',LaravelTrials::generateEmailForRole($timestamp,'user'));
    }

    /** @test */
    public function getAuthValue_works_without_session_config(){
        $this->app['config']->set('laravel-trials.auth_mode', 'something');
        $this->assertEquals(null,LaravelTrials::getAuthValue());
    }

    /** @test */
    public function getAuthValue_works_without_session(){
        $this->assertEquals(null,LaravelTrials::getAuthValue());
    }

    /** @test */
    public function getAuthValue_works_with_session(){
        Session::now(config('laravel-trials.session_field'),'abc');
        $this->assertEquals('abc',LaravelTrials::getAuthValue());
    }

    /** @test */
    public function inTrial_works_without_session_value(){
        $this->assertFalse(LaravelTrials::inTrial());
    }

    /** @test */
    public function inTrial_works_with_session_value(){
        Session::now(config('laravel-trials.session_field'),'abc');
        $this->assertTrue(LaravelTrials::inTrial());
    }

    /** @test */
    public function inTrial_works_without_auth_mode(){
        $this->app['config']->set('laravel-trials.auth_mode', 'something');
        $this->assertFalse(LaravelTrials::inTrial());
    }

    /** @test */
    public function createTrialForEmail_creates_item(){
        $this->assertEquals(1,LaravelTrials::createTrialForEmail('email@example.com'));
    }
}