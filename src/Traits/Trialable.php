<?php

namespace Dukevomv\LaravelTrials\Traits;

use Dukevomv\LaravelTrials\LaravelTrials;
use Dukevomv\LaravelTrials\Scopes\OnlyTrialScope;
use Dukevomv\LaravelTrials\Scopes\WithoutTrialScope;
use Illuminate\Support\Facades\Auth;

trait Trialable
{

    public function addTrialableEntity()
    {
        $authValue = LaravelTrials::getAuthValue();
        if (config('laravel-trials.enabled') && !is_null($authValue)) {
            $this->trial_entity()->create([config('laravel-trials.identifier_field') => $authValue]);
        }
    }

    public function trial_entity()
    {
        return $this->morphOne(
          config('laravel-trials.model.trial_entity'), config('laravel-trials.model.polymorph_name')
        );
    }

    public function trials()
    {
        return $this->morphToMany(
          config('laravel-trials.model.trial'), config('laravel-trials.model.polymorph_table'),
          config('laravel-trials.model.polymorph_name')
        );
    }

    public function getTrial()
    {
        return $this->trials()->first();
    }

    protected static function boot()
    {
        static::created(function ($model) {
            $model->addTrialableEntity();
        });

        if (!Auth::guest()) {
            if (LaravelTrials::inTrial()) {
                static::addGlobalScope(new OnlyTrialScope);
            } else {
                static::addGlobalScope(new WithoutTrialScope);
            }
        }
        parent::boot();
    }

}