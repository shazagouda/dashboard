<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
        protected $table = 'user_details';
    protected $fillable = [
//details
        'firstname',
        'lastname',

        'email',
        'phone',

        //password
       'password',

    ];

}
