<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{
    use HasUuids;

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
}
