@can('programs.edit')
  <a href="{{ route('programs.edit', $uuid) }}" class="text-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.programs.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('programs.destroy')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-2 delete-programs" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.programs.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

<script src="{{ asset('assets/custom/js/tooltip.js') }}"></script>