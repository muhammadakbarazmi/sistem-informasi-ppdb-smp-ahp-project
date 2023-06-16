@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Alternatif</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Form Input Data Alternatif</h5>
                </div>

                <div class="card-body">
                    
                        <form action="{{ route('postalternatif') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Id Alternatif') }}</label>
                                <input class="form-control" name="code" placeholder="Id Alternatif" type="text">
                            </div>
                            <br>
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Alternatif') }}</label>
                                <input class="form-control" name="name" placeholder="Nama Alternatif" type="text">
                            </div>
                            <br>
                            <!-- <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control" placeholder="Confirm Password" type="password">
                            </div>
                            <br> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-block" onclick="kembaliAlternatif();">Cancel</button>
                                </div>
                            </div>
                        </form>
                    <!-- Script -->
                    <script>
                        function kembaliAlternatif() {
                            window.location.href = "/admin/alternatif";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection