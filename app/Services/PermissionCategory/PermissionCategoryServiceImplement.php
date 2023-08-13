<?php

namespace App\Services\PermissionCategory;

use LaravelEasyRepository\Service;
use App\Repositories\PermissionCategory\PermissionCategoryRepository;
use Illuminate\Support\Facades\DB;

class PermissionCategoryServiceImplement extends Service implements PermissionCategoryService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(PermissionCategoryRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function with(array $with = [])
  {
    return DB::transaction(function () use ($with) {
      return $this->mainRepository->with($with);
    });
  }
}
