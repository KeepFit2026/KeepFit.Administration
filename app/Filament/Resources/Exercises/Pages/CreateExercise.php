<?php

namespace App\Filament\Resources\Exercises\Pages;

use App\Filament\Resources\Exercises\ExerciseResource;
use App\Services\ExerciseService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateExercise extends CreateRecord
{
    protected static string $resource = ExerciseResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $apiService = app(ExerciseService::class);
        $result = $apiService->CreateAsync($data);
        return static::getModel()::make($result);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
