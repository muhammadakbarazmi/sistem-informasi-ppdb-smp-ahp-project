@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Kriteria</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Form Update Data Kriteria</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('siswa.update', $Siswa->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('Id') }}</label>
                            <input class="form-control" name="id" placeholder="Id" type="text" value="{{ $Siswa->id }}" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="no_peserta" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Peserta') }}</label>
                            <input class="form-control" name="no_peserta" placeholder="Nomor Peserta" type="text" value="{{ $Siswa->no_peserta }}">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>
                            <input class="form-control" name="nama" placeholder="Nama Lengkap" type="text" value="{{ $Siswa->nama }}">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                            <input class="form-control" name="alamat" placeholder="Alamat" type="text" value="{{ $Siswa->alamat }}">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" placeholder="dd-mm-yyyy" 
                            value="{{ $Siswa->tanggal_lahir }}" min="1997-01-01" max=<?php echo date('Y-m-d'); ?> placeholder="Pilih Tanggal">
                        </div>
                        <br>
                        <div class="input-group">
                        <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" value="{{ $Siswa->jenis_kelamin }}">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select> 
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="gambar" class="col-md-4 col-form-label text-md-end">{{ __('Masukkan Foto') }}</label>
                            <input class="form-control" name="gambar" type="file" value="{{ $Siswa->gambar }}">
                        </div>
                        <br>
                        <!-- <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input class="form-control" placeholder="Confirm Password" type="password">
                        </div>
                        <br> -->
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Update Data</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-warning btn-block" onclick="kembalisiswa();">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END MAIN CONTENT -->
            </div>
        </div>    
    </div>
</div>

<script>
    function kembalisiswa() {
        window.location.href = "/admin/siswa";
    }
</script>
@endsection