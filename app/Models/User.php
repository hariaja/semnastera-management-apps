<?php

namespace App\Models;

use App\Helpers\Enum\RoleType;
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
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

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
   * Define badge type roles.
   *
   * @return string
   */
  public function getRoleBadge(): string
  {
    $roleName = $this->isRoleName();

    switch ($roleName) {
      case RoleType::ADMIN->value:
        $badgeClass = 'badge text-smooth';
        break;
      case RoleType::REVIEWER->value:
        $badgeClass = 'badge text-info';
        break;
      case RoleType::PEMAKALAH->value:
        $badgeClass = 'badge text-warning';
        break;
      case RoleType::PARTICIPANT->value:
        $badgeClass = 'badge text-danger';
        break;
      default:
        $badgeClass = 'badge';
        break;
    }

    return "<span class='{$badgeClass}'>{$roleName}</span>";
  }

  /**
   * Define badge status account.
   *
   * @return string
   */
  public function getAccountStatus(): string
  {
    $badgeClass = ($this->status == StatusUserType::ACTIVE->value) ? 'badge text-success' : 'badge text-danger';
    $badgeText = ($this->status == StatusUserType::ACTIVE->value) ? 'Active' : 'Inactive';

    return "<span class='{$badgeClass}'>{$badgeText}</span>";
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

  /**
   * Get all user except :value
   *
   * @param  mixed $query
   * @return void
   */
  public function scopeWhereNot($query)
  {
    return $query->whereDoesntHave('roles', function ($row) {
      $row->where('name', RoleType::ADMIN->value);
    });
  }

  /**
   * Relation to Participant Model.
   *
   * @return HasOne
   */
  public function participant(): HasOne
  {
    return $this->hasOne(Participant::class, 'user_id');
  }
}
