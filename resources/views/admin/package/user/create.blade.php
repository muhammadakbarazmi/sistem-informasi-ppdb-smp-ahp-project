@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Data User</h1>

    <div class="row justify-content-center">

        <div class="col-md-8">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Form Input Data User</h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <input class="form-control" name="name" placeholder="Name" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <input class="form-control" name="email" placeholder="Email" type="text">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <input class="form-control" name="password" placeholder="Password" type="password">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <input class="form-control" placeholder="Confirm Password" type="password">
                        </div>
                        <br>
                        <div class="">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Level') }}</label>
                            <label class="fancy-radio">
                                <input name="level" value="admin" type="radio">
                                <span><i></i>Admin</span>
                            </label>
                            <label class="fancy-radio">
                                <input name="level" value="guru" type="radio">
                                <span><i></i>Guru</span>
                            </label>
                            <label class="fancy-radio">
                                <input name="level" value="siswa" type="radio">
                                <span><i></i>Siswa</span>
                            </label>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                            <input class="form-control" name="alamat" placeholder="Alamat" type="text" value="{{ old('alamat') }}">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal Lahir') }}</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" aria-describedby="tanggal_lahir" placeholder="dd-mm-yyyy" value="{{ old('tanggal_lahir') }}" min="1997-01-01" max=<?php echo date('Y-m-d'); ?>
                                placeholder="Pilih Tanggal">
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <br>
                        <div class="input-group">
                            <label for="gambar" class="col-md-4 col-form-label text-md-end">{{ __('Masukkan Foto') }}</label>
                            <input class="form-control" name="gambar" type="file" value="{{ old('gambar') }}">
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">Simpan Data</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-warning btn-block" onclick="kembaliuser();">Cancel</button>
                            </div>
                        </div>
                    </form>
                        
                    <!-- Script -->
                    <script>
                        function kembaliuser() {
                            window.location.href = "/admin/user";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection