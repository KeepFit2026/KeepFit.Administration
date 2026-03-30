<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;

class User extends Model
{
    use HasUuids, HasApiTokens, Notifiable;

    protected $connection = 'pgsql_second';
    protected $table = 'users';
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'account_id',
    ];

    public function login(): BelongsTo
    {
        return $this->belongsTo(Login::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }
}
