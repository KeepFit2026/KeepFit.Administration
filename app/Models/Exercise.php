<?php

namespace App\Models;

use App\Services\ExerciseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Sushi\Sushi;

class Exercise extends Model
{
    use Sushi;

    protected $connection = 'sqlsrv_auth';
    protected $table = 'exercise';
    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Description'
    ];

    protected $shema = [
        'id' => 'string',
        'name' => 'string',
        'description' => 'string',
        'programsLink' => 'string'
    ];

    /**
     * A l'aide de 'Sushi', permet de récup les données via l'API
     * et créer des tables temporaires en mémoire
     */
    public function getRows()
    {
        $apiService = app(ExerciseService::class);
        $exercises = $apiService->GetAllAsync();
        return $exercises['data'];
    }
}
