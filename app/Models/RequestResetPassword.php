<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestResetPassword extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'requestResetPassword';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'accountId',
        'link'
    ];
}
