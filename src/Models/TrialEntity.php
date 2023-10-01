<?php

namespace Dukevomv\LaravelTrials\Models;

use Illuminate\Database\Eloquent\Model;

class TrialEntity extends Model {
    public $timestamps = false;
    protected $guarded = [];

    //todo - make this to work from config name
    public function trialable(){
        return $this->morphTo();
    }
}