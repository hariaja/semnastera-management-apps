<?php

namespace App\DataTables\Permissions;

use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\PermissionCategory;
use App\Services\Role\RoleService;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use App\Services\PermissionCategory\PermissionCategoryService;

class PermissionCategoryDataTable extends DataTable
{
  protected $role;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected PermissionCategoryService $permissionCategoryService,
  ) {
    // 
  }

  /**
   * Get Relation to Role Model.
   */
  public function setRole(Role $role)
  {
    $this->role = $role;
    return $this;
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('permissions', function ($row) {
        return View::make('settings.permissions.checkbox', [
          'permissions' => $row->permissions,
          'rolePermissions' => $this->getRolePermissions($this->role), // Call a method to get role permissions
        ])->render();
      })
      ->editColumn('name', fn ($row) => trans('permission.' . $row->name))
      ->rawColumns([
        'permissions',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(PermissionCategory $model): QueryBuilder
  {
    return $model->with(['permissions'], function ($query) {
      $query->whereIn('id', $this->roleService->roleHasPermissions($this->role->id));
    });
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('permissioncategory-table')
      ->columns($this->getColumns())
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
        'table-responsive',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('name')
        ->title('Nama')
        ->className('text-center fw-semibold'),
      Column::computed('permissions')->title('Izin'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'PermissionCategory_' . date('YmdHis');
  }

  public function getRolePermissions($role)
  {
    if ($role) {
      return $this->roleService->roleHasPermissions($role->id);
    } else {
      return [];
    }
  }
}
