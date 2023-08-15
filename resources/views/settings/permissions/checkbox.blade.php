<div class="space-y-2">
  @foreach ($permissions as $item)
    <div class="form-check">
      <input class="permission form-check-input @error('permission') is-invalid @enderror" name="permission[{{ $item->name }}]" id="permission-{{ $item->name }}" type="checkbox" value="{{ $item->name }}" {{ in_array($item->name, $rolePermissions) ? 'checked' : '' }}>
      <label class="form-check-label" for="permission-{{ $item->name }}">{{ trans('permission.' . $item->name) }}</label>
    </div>
  @endforeach
</div>