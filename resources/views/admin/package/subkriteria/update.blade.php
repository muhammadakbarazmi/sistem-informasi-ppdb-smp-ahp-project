@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Sub Kriteria</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Form Update Data Sub Kriteria</h5>
                </div>

                <div class="card-body">
                    @foreach($data_sub as $DS)
                        <form action="/admin/sub/formedit/updatesub/{id}" method="post">
                            @csrf
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Code Sub Kriteria') }}</label>
                                <input class="form-control" name="code" placeholder="Code Sub Kriteria" type="text" value="{{ $DS->code }}" readonly>
                            </div>
                            <br>
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Kriteria') }}</label>
                                <select class="form-control" name="cbname">
                                    @if($data_crt->count() > 0)
                                    @foreach($data_crt as $DC)
                                    @if($DC->name == $DS->name)
                                    <option value="{{ $DS->name }}" selected>{{ $DC->name }}</option>
                                    @else
                                    <option value="{{ $DC->name }}">{{ $DC->name }}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option value="none" disabled>Data kriteria tidak tersedia</option>
                                    @endif
                                </select>
                            </div>
                            <br>
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nilai Kriteria') }}</label>
                                <input class="form-control" name="nilaik" placeholder="Nilai Kriteria" type="text" value="{{ $DS->nilaik }}">
                            </div>
                            <br>
                            <div class="input-group">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nilai Bobot Kriteria Kriteria') }}</label>
                                <select class="form-control" name="cbnilaib">
                                    @if($DS->nilaib == 1)
                                    <option value="1" selected>Kurang (Nilai = 1)</option>
                                    <option value="2">Sedang (Nilai = 2)</option>
                                    <option value="3">Cukup (Nilai = 3)</option>
                                    <option value="4">Baik (Nilai = 4)</option>
                                    <option value="5">Sangat Baik (Nilai = 5)</option>
                                    @elseif($DS->nilaib == 2)
                                    <option value="1">Kurang (Nilai = 1)</option>
                                    <option value="2" selected>Rata-Rata (Nilai = 2)</option>
                                    <option value="3">Cukup (Nilai = 3)</option>
                                    <option value="4">Baik (Nilai = 4)</option>
                                    <option value="5">Sangat Baik (Nilai = 5)</option>
                                    @elseif($DS->nilaib == 3)
                                    <option value="1">Kurang (Nilai = 1)</option>
                                    <option value="2">Sedang (Nilai = 2)</option>
                                    <option value="3" selected>Tinggi (Nilai = 3)</option>
                                    <option value="4">Baik (Nilai = 4)</option>
                                    <option value="5">Sangat Baik (Nilai = 5)</option>
                                    @elseif($DS->nilaib == 4)
                                    <option value="1">Kurang (Nilai = 1)</option>
                                    <option value="2">Sedang (Nilai = 2)</option>
                                    <option value="3">Cukup (Nilai = 3)</option>
                                    <option value="4" selected>Baik (Nilai = 4)</option>
                                    <option value="5">Sangat Baik (Nilai = 5)</option>
                                    @elseif($DS->nilaib == 5)
                                    <option value="1">Kurang (Nilai = 1)</option>
                                    <option value="2">Sedang (Nilai = 2)</option>
                                    <option value="3">Cukup (Nilai = 3)</option>
                                    <option value="4">Baik (Nilai = 4)</option>
                                    <option value="5" selected>Sangat Baik (Nilai = 5)</option>
                                    @else
                                    <option value="1">Kurang (Nilai = 1)</option>
                                    <option value="2">Sedang (Nilai = 2)</option>
                                    <option value="3">Cukup (Nilai = 3)</option>
                                    <option value="4">Baik (Nilai = 4)</option>
                                    <option value="5">Sangat Baik (Nilai = 5)</option>
                                    @endif
                                </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary btn-block">Update Data</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-warning btn-block" onclick="kembalisub();">Cancel</button>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                    <!-- Script -->
                    <script>
                        function kembalisub() {
                            window.location.href = "/admin/sub";
                        }
                    </script>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
    </div>
</div>
@endsection