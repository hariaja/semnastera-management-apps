<?php

namespace App\Models;

use App\Helpers\Enum\ScheduleType;
use App\Helpers\Enum\StatusScheduleType;
use App\Traits\Uuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
  use HasFactory, Uuid;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'uuid',
    'program_id',
    'type',
    'start_date',
    'end_date',
    'status',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'start_date' => 'date:c',
    'end_date' => 'date:c',
  ];

  /**
   * Get the route key for the model.
   */
  public function getRouteKeyName(): string
  {
    return 'uuid';
  }

  /**
   * Relation model.
   *
   * @var array
   */
  protected $with = [
    'program',
  ];

  /**
   * Get schedule type in badge class
   *
   * @return string
   */
  public function getScheduleType(): string
  {
    $type = $this->type;

    switch ($type) {
      case ScheduleType::UPLOAD->value:
        $badgeClass = 'badge bg-amethyst';
        break;
      case ScheduleType::SEMINAR->value:
        $badgeClass = 'badge bg-modern';
        break;
      default:
        $badgeClass = 'badge';
        break;
    }

    return "<span class='{$badgeClass}'>{$type}</span>";
  }

  /**
   * Get status schedule type in badge class
   *
   * @return string
   */
  public function getStatusScheduleType(): string
  {
    $status = $this->status;

    switch ($status) {
      case StatusScheduleType::OPEN->value:
        $badgeClass = 'badge bg-success';
        break;
      case StatusScheduleType::CLOSE->value:
        $badgeClass = 'badge bg-danger';
        break;
      default:
        $badgeClass = 'badge';
        break;
    }

    return "<span class='{$badgeClass}'>{$status}</span>";
  }

  public function isDiffInDays()
  {
    $startDate = Carbon::parse($this->start_date);
    $endDate = Carbon::parse($this->end_date);
    return $startDate->diffInDays($endDate);
  }

  /**
   * Relation to Program Model.
   *
   * @return BelongsTo
   */
  public function program(): BelongsTo
  {
    return $this->belongsTo(Program::class, 'program_id');
  }
}
