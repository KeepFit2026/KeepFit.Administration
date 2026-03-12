<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
class Program extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'programs';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
