<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class, 'program_sessions');
    }

    /**
     * Retourne le nombre de séance dans un programme.
     * @return integer Le nombre de séances.
     */
    public function getSessionsCountAttribute(): int
    {
        return $this->sessions()->count();
    }
}
