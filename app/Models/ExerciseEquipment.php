<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExerciseEquipment extends Model
{
    protected $connection = 'pgsql_second';
    protected $table = 'exercise_equipments';
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $fillable = [
        
    ];
}
