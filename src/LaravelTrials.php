<?php

namespace Dukevomv\LaravelTrials;

use Dukevomv\LaravelTrials\Models\Trial;
use Illuminate\Support\Facades\Session;

class LaravelTrials
{
    /**
     * @param $postfix
     * @param $role
     *
     * @return string
     */
    public static function generateEmailForRole($postfix, $role) {
        return $role . '+' . $postfix . '@' . config('laravel-trials.email_suffix');
    }

    public static function generateNameFromEmail($email) {
        $emailParts = explode('@', $email);
        return ucfirst($emailParts[0]);
    }

    public static function getAuthValue(){
        if(config('laravel-trials.auth_mode') === 'session'){
            return Session::get(config('laravel-trials.session_field'));
        }
        return null;
    }

    public static function inTrial(){
        return !is_null(self::getAuthValue());
    }

    public static function createTrialForEmail($email,$status = 'active',$details = []){
        // TODO [#1]: Fail creation of trial if already exists
        return Trial::firstOrCreate(['email'=>$email],compact(['status','details']));
    }
}
