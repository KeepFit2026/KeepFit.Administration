<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Difficulty extends Model
{
    use HasUuids;
    
    protected $connection = 'pgsql_second';
    protected $table = 'difficulties';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];

    public function exercices(): HasMany
    {
        return $this->hasMany(Exercise::class, 'difficulty_id');
    }
}
