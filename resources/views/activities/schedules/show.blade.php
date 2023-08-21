<div class="modal fade" id="modal-show-schedule" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"></h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Kategori') }}
              <span class="fw-semibold" id="schedule-type"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Mulai Pada') }}
              <span class="fw-semibold" id="schedule-start-date"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Selesai Pada') }}
              <span class="fw-semibold" id="schedule-end-date"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Jadwal') }}
              <span class="fw-semibold" id="schedule-status"></span>
            </li>
          </ul>

          <div class="mb-3">
            <h2 class="content-heading pt-0">
              <i class="fa fa-fw fa-skating me-1"></i>
              {{ trans('page.programs.show') }}
            </h2>
          </div>

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nama') }}
              <span class="fw-semibold" id="program-name"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Lokasi') }}
              <span class="fw-semibold" id="program-location"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Penanggung Jawab') }}
              <span class="fw-semibold" id="program-responsible"></span>
            </li>
          </ul>

        </div>
        <div class="block-content block-content-full block-content-sm text-end border-top">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            {{ trans('Close') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>