@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">About This System</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="{{ asset('img/undraw_posting_photo.svg') }}">
                    </div>
                    <p>Sistem yang akan dibangun adalah sebuah Sistem Pendaftaran Siswa (Studi Kasus: SMP ISLAM THORIQUL HUDA PONOROGO) menggunakan Metode 
                        Analytical Hierarchy Process dimana penerimaan siswa baru dapat dinilai dengan parameter yang ditentukan.
                        Seluruh siswa tersebut dapat dirangking berdasarkan hasil perhitungan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
