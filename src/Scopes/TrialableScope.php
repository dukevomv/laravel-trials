<?php
namespace Dukevomv\LaravelTrials\Scopes;

use Dukevomv\LaravelTrials\LaravelTrials;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

abstract class TrialableScope implements Scope
{

    public function onlyEntity(Builder $builder){
        $authValue = LaravelTrials::getAuthValue();
        if(!is_null($authValue)){
            $builder->whereHas('trial_entity', function($q) use ($authValue) {
                $q->where(config('laravel-trials.identifier_field'), $authValue);
            });
        }
    }

    public function withoutEntity(Builder $builder){
        $builder->has('trial_entity', '=', 0);
    }
}