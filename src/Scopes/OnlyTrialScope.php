<?php
namespace Dukevomv\LaravelTrials\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OnlyTrialScope extends TrialableScope
{
    public function apply(Builder $builder, Model $model)
    {
        $this->onlyEntity($builder);
    }
}