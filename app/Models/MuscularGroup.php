<?php

namespace App\Models;

use App\Services\MuscleGroupService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

class MuscularGroup extends Model
{
    use Sushi;

    protected $connection = 'sqlsrv_auth';
    protected $table = 'musclegroup';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Name',
    ];

    protected $schema = [
        'id' => 'string',
        'name' => 'string',
    ];

    /**
     * A l'aide de 'Sushi', permet de récup les données via l'API
     * et créer des tables temporaires en mémoire
     */
    public function getRows()
    {
        $apiService = app(MuscleGroupService::class);
        $groups = $apiService->GetAllAsync();
        return $groups['data'] ?? [];
    }

    public function delete()
    {
        app(MuscleGroupService::class)->DeleteAsync($this->id);
        return parent::delete();
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'muscle_group_id');
    }

    public static function clearCache(): void
    {
        Cache::forget(static::class . '_rows');
    }
}
