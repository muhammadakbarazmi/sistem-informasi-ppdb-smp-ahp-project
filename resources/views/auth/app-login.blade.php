<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin PPDB SMP - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

</head>

<body class="bg-gradient-primary">

    @yield('content')

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
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

</body>

</html>
