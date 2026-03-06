<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'users';
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'account_id',
    ];
}
