<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Login extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory, HasUuids, HasRoles, Notifiable;

    protected $connection = 'pgsql';
    protected $table = 'login';
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'email_verified_at'
    ];

    protected $appends = ['username', 'role'];

    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Pour que Login reconnait username meme s'il n'existe pas dans une table (pour LoginExporter)
     * @return Attribute
     */
    public function username(): Attribute
    {
        return Attribute::make(
            get: fn() => null
        );
    }

     /**
     * Pour que Login reconnait role meme s'il n'existe pas dans une table (pour LoginExporter)
     * @return Attribute
     */
    public function role(): Attribute
    {
        return Attribute::make(
            get: fn() => null
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'account_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->user?->name ?? $this->email;
    }
}