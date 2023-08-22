<?php

namespace App\Http\Controllers;

use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Helper;
use App\Services\Program\ProgramService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected ProgramService $programService,
  ) {
    $this->middleware(['auth', 'verified']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $data = [
      'user_count' => $this->userService->getUserNotAdmin()->count(),
      'program_count' => $this->programService->query()->select('*')->count(),
    ];

    return Helper::getHomeView(isRoleName(), $data);
  }
}
