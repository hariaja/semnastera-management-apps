<?php

namespace App\Models;

use App\Helpers\Enum\StatusUserType;
use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, HasFactory, Notifiable, HasRoles, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
    'email',
    'phone',
    'password',
    'avatar',
    'status',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the user role name.
   */
  public function isRoleName(): string
  {
    return $this->roles->implode('name');
  }

  /**
   * Get the user role id.
   */
  public function isRoleId(): int
  {
    return $this->roles->implode('id');
  }

  /**
   * Get the user avatar.
   *
   */
  public function userAvatar()
  {
    if (!$this->avatar) :
      return asset('assets/images/default.png');
    else :
      return Storage::url($this->avatar);
    endif;
  }

  /**
   * Scope a query to only include active users.
   */
  public function scopeActive($data)
  {
    return $data->where('status', StatusUserType::ACTIVE->value);
  }

  /**
   * Get Active User
   */
  public function getActive(): Collection
  {
    return $this->active()->get();
  }

  /**
   * Scope a query to only include inactive users.
   */
  public function scopeInactive($data)
  {
    return $data->where('status', StatusUserType::INACTIVE->value);
  }

  /**
   * Get Inactive User
   */
  public function getInactive(): Collection
  {
    return $this->inactive()->get();
  }

  public function participant(): HasOne
  {
    return $this->hasOne(Participant::class, 'user_id');
  }
}
