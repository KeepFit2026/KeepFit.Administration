<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipment extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'equipments';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];

    protected function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'exercise_equipments', 'equipment_id', 'exercise_id');
    }
}
