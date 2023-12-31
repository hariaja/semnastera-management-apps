<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'name',
    'location',
    'responsible',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Define location program
   *
   * @return string
   */
  public function isLocation(): string
  {
    return $this->location ?: '--';
  }

  /**
   * Relation to Schedule Model.
   *
   * @return HasMany
   */
  public function schedules(): HasMany
  {
    return $this->hasMany(Schedule::class, 'program_id');
  }
}
