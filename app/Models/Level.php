<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'levels';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'number',
        'required_xp'
    ];
}
