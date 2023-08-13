<?php

namespace App\Services\Role;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Role\RoleRepository;

class RoleServiceImplement extends Service implements RoleService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(RoleRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function baseQuery()
  {
    return DB::transaction(function () {
      return $this->mainRepository->baseQuery();
    });
  }

  public function selectRoleWhereIn(array $name = [])
  {
    return DB::transaction(function () use ($name) {
      return $this->mainRepository->selectRoleWhereIn($name);
    });
  }

  public function storeNewRole($request)
  {
    return DB::transaction(function () use ($request) {
      return $this->mainRepository->storeNewRole($request);
    });
  }
}
