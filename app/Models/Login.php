<?php

namespace App\Models;

use App\Enum\UserRole;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;

class Login extends Authenticatable implements JWTSubject, FilamentUser, HasName
{
    use HasFactory;

    protected $connection = 'pgsql';
    protected $table = 'login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'roleId'
    ];

    protected $hidden = [
        'password'
    ];

    protected $cast = [
        'roleId' => UserRole::class,
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Retourne l'id du Role de l'untilisateur à partir de l'AccountId.
     */
    public static function FindRoleByAccountId(string $accountId): ?int
    {
        $role = self::where('id', $accountId)->first();
        return $role ? $role->roleId : null;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return $this->email;
    }
}