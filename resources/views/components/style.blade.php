<!-- Stylesheets -->
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/magnific-popup/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/simplemde/simplemde.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/css/oneui.min.css') }}" id="css-main">

<!-- Datatables -->
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/src/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">

<style>
.float-custom {
  position: fixed;
  z-index: 314159;
  width: 60px;
  height: 60px;
  bottom: 40px;
  right: 40px;
  background-color: #25d366;
  color: #FFF;
  border-radius: 50px;
  text-align: center;
  font-size: 30px;
  box-shadow: 2px 2px 3px #999;
}

.my-float {
  margin-top: 16px;
}
</style>

@stack('css')
<link rel="stylesheet" href="{{ asset('assets/custom/css/custom.css') }}">
<!-- END Stylesheets -->