<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Exercise extends Model
{
    use HasUuids;

    protected $connection = 'pgsql_second';
    protected $table = 'exercises';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'muscular_group_id',
        'difficulty_id',
    ];

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscularGroup::class, 'muscular_group_id');
    }

    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class, 'difficulty_id');
    }
}

