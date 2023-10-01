<?php
namespace Dukevomv\LaravelTrials\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WithoutTrialScope extends TrialableScope
{
    public function apply(Builder $builder, Model $model)
    {
        $this->withoutEntity($builder);
    }
}