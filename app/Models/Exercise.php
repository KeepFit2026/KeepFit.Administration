<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Exercise extends Model
{
    use HasUuids, LogsActivity;

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

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class, 'exercise_sessions');
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'exercise_equipments', 'exercise_id', 'equipment_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'difficulty_id', 'muscular_group_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}

