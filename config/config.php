<?php

return [
  'enabled'          => env('TRIALS_ENABLED', false),
  'auth_mode'        => 'session', // you can use session,jwt or leave empty and override with custom code within Facade
  'email_suffix'     => 'example.com',
  'default_role'     => 'admin',
  'session_field'    => 'admin_user_timestamp',
  'identifier_field' => 'trial_id',
    //  'expiration_time_in_days' => 15,
    //  'archive_trials_after_days' => 365,
  'model'            => [
    'user'            => \Illuminate\Auth\Authenticatable::class,  //replace below with your User model
    'trial'           => Dukevomv\LaravelTrials\Models\Trial::class,  //replace below with your User model
    'trial_entity'    => Dukevomv\LaravelTrials\Models\TrialEntity::class,  //replace below with your User model
    'polymorph_name'  => 'trialable',
    'polymorph_table' => 'trial_entities',
  ],
];