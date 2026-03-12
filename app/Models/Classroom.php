<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasUuids, SoftDeletes;

    protected $connection = 'pgsql_second';
    protected $table = 'classrooms';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];
}

