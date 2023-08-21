@can('schedules.edit')
  <a href="{{ route('schedules.edit', $uuid) }}" class="text-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.schedules.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('schedules.show')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-modern me-2 show-schedules" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.schedules.show') }}"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('schedules.destroy')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-2 delete-schedules" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.schedules.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

<script src="{{ asset('assets/custom/js/tooltip.js') }}"></script>