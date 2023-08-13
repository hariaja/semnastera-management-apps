<script src="{{ asset('assets/src/js/oneui.app.min.js') }}"></script>
<script src="{{ asset('assets/src/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('assets/custom/js/custom.js') }}"></script>
<script src="{{ asset('assets/custom/js/tooltip.js') }}"></script>

{{-- @vite('resources/js/global/custom.js') --}}

<!-- Plugin JS -->
<script src="{{ asset('assets/src/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.j') }}s"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<!-- Page JS Code -->
<script src="{{ asset('assets/src/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/simplemde/simplemde.min.js') }}"></script>
<script src="{{ asset('assets/src/js/pages/be_tables_datatables.min.js') }}"></script>
<script src="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
  One.helpersOnLoad([
    'jq-select2',
    'jq-magnific-popup',
    'jq-datepicker',
    'js-flatpickr',
    'js-ckeditor',
  ])
</script>

@include('sweetalert::alert')
@stack('javascript')
@include('components.alert')