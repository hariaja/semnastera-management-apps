<?php

namespace App\DataTables\Activities;

use App\Helpers\Global\Helper;
use App\Models\Schedule;
use App\Services\Schedule\ScheduleService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ScheduleDataTable extends DataTable
{
  /**
   * Create a new datatables instance.
   *
   * @return void
   */
  public function __construct(
    protected ScheduleService $scheduleService,
  ) {
    // 
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->addColumn('program', fn ($row) => $row->program->name)
      ->editColumn('type', fn ($row) => $row->getScheduleType())
      ->editColumn('status', fn ($row) => $row->getStatusScheduleType())
      ->editColumn('start_date', fn ($row) => Helper::parseDateTime($row->start_date))
      ->editColumn('end_date', fn ($row) => Helper::parseDateTime($row->end_date))
      ->addColumn('diff_in_days', fn ($row) => "{$row->isDiffInDays()} Hari")
      ->addColumn('action', 'activities.schedules.action')
      ->rawColumns([
        'type',
        'status',
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Schedule $model): QueryBuilder
  {
    return $this->scheduleService->query()->latest();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('schedule-table')
      ->columns($this->getColumns())
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
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
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('5%')
        ->addClass('text-center'),
      Column::make('type')
        ->title(trans('Kategori Jadwal'))
        ->addClass('text-center'),
      Column::make('start_date')
        ->title(trans('Mulai Pada'))
        ->addClass('text-center'),
      Column::make('end_date')
        ->title(trans('Selesai Pada'))
        ->addClass('text-center'),
      Column::make('diff_in_days')
        ->title(trans('Lama (Hari)'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Schedule_' . date('YmdHis');
  }
}
