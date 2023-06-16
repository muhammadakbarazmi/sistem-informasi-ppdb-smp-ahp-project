<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
    @if (Session::has('success'))
        toastr.success("{{ session('success') }}", 'Sukses');
    @endif
    @if (Session::has('error'))
        toastr.error("{{ session('error') }}", 'Error');
    @endif
    @if (Session::has('errors'))
        toastr.error("@foreach ($errors->all() as $error){{ $error }}@endforeach", 'Error');
    @endif
    @if (Session::has('info'))
        toastr.info("{{ session('info') }}", 'Info');
    @endif
    @if (Session::has('warning'))
        toastr.warning("{{ session('warning') }}", 'Warning');
    @endif
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- jQuery -->
<script src="{{ asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
<script src="{{ asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>