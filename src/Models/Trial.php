<?php

namespace Dukevomv\LaravelTrials\Models;

use Illuminate\Database\Eloquent\Model;

class Trial extends Model
{

    protected $fillable = ['email', 'details', 'status', 'uuid'];
    protected $casts = ['details' => 'array'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($item) {
            $item->uuid = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 12);
        });
    }

    public function users()
    {
        return $this->morphedByMany(
          config('laravel-trials.model.user'), config('laravel-trials.model.polymorph_name'),
          config('laravel-trials.model.polymorph_name')
        );
    }

    /**
     * @param $postfix
     * @param $role
     *
     * @return string
     */
    public static function generateEmailForRole($postfix, $role)
    {
        return $role.'+'.$postfix.'@'.config('laravel-trials.email_suffix');
    }

    public static function generateNameFromEmail($email)
    {
        $emailParts = explode('@', $email);
        return ucfirst($emailParts[0]);
    }

}