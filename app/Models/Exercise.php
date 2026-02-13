<?php

namespace App\Models;

use App\Enum\Difficulty;
use App\Services\ExerciseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Sushi\Sushi;

class Exercise extends Model
{
    use Sushi;

    protected $connection = 'sqlsrv_auth';
    protected $table = 'exercise';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Name',
        'Description',
        'muscleGroupId'
    ];

    protected $casts = [
        'difficulty' => Difficulty::class
    ];

    protected $schema = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'muscleGroupId' => 'string',
        'difficulty' => 'integer'
    ];

    /**
     * A l'aide de 'Sushi', permet de récup les données via l'API
     * et créer des tables temporaires en mémoire
     */
    public function getRows()
    {
        $apiService = app(ExerciseService::class);
        $exercises = $apiService->GetAllAsync();
        Log::info('Exercises chargés depuis API:', ['count' => count($exercises['data'] ?? [])]);
        return $exercises['data'] ?? [];
    }

    public function delete()
    {
        app(ExerciseService::class)->DeleteAsync($this->id);
        return parent::delete();
    }

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscularGroup::class, 'muscleGroupId');
    }
}
