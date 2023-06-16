<!DOCTYPE html>
<html lang="en">

<head>

    <title>SPK Pendaftaran Siswa SMP Thoriqul Huda Ponorogo Menggunakan Metode AHP  - Dashboard</title>
    @include('guru.layouts.head')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('guru.layouts.left-sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('guru.layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('guru.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('guru.layouts.logout-modal')

    <!-- Bootstrap core JavaScript-->
    @include('guru.layouts.script')

    @stack('script')

</body>

</html>
