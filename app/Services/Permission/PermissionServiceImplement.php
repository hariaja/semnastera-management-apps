<?php

namespace App\Services\Permission;

use LaravelEasyRepository\Service;
use App\Repositories\Permission\PermissionRepository;

class PermissionServiceImplement extends Service implements PermissionService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(PermissionRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
