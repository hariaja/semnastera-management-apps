@canany(['users.edit', 'participants.edit'])
  @if ($model->hasRole(RoleType::PEMAKALAH->value) || $model->hasRole(RoleType::PARTICIPANT->value))
    <a href="{{ route('participants.edit', $model->participant->uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @else
    <a href="{{ route('users.edit', $uuid) }}" class="text-warning me-2"><i class="fa fa-sm fa-pencil"></i></a>
  @endif
@endcan
@can('users.destroy')
  @if ($model->hasRole(RoleType::ADMIN->value))
    <span class="badge text-smooth">{{ trans('Tidak Bisa Dihapus') }}</span>
  @else
    <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-2 delete-users" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.users.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
  @endif
@endcan
<script src="{{ asset('assets/custom/js/tooltip.js') }}"></script>