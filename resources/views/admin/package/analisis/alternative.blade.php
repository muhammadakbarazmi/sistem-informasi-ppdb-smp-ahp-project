@extends('admin.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perbandingan Alternatif</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-4 mb-4">
            <!-- Form Tambah Karyawan -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Perbandingan Siswa</h6>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('addRatioAlternative') }}">
                    @csrf
                    <div class="form-group">
                        <label for="criteria">Kriteria</label>
                        <select class="form-control" id="citeria" name="criteria">
                            @foreach ($data->criteria as $criterias)
                            <option value="{{$criterias['id']}}" {{ (old("criteria") == $criterias['id'] ? "selected":"") }}>{{$criterias['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="v_alternative">Alternative 1</label>
                        <select class="form-control" id="v_alternative" name="v_alternative">
                            @foreach ($data->alternative as $alternatives)
                            <option value="{{$alternatives['id']}}">{{$alternatives['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="h_alternative">Alternative 2</label>
                        <select class="form-control" id="h_alternative" name="h_alternative">
                            @foreach ($data->alternative as $alternatives)
                            <option value="{{$alternatives['id']}}">{{$alternatives['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">Value Perbandingan</label>
                        <input type="number" class="form-control" id="value" name="value">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            @foreach ($data->criteria as $criterias)
            <div class="row">
                <div class="col-lg-12">
                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCard{{$criterias['id']}}" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCard{{$criterias['id']}}">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Perbandingan Kriteria : {{$criterias['name']}}</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse" id="collapseCard{{$criterias['id']}}" style="">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Alternative 1</th>
                                        <th scope="col">Alternative 2</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach ($data->ratio as $ratios)
                                        @if ($ratios['criterias_name'] == $criterias['name'])
                                        <tr>
                                            <th scope="row">
                                                @php
                                                    $counter++;
                                                @endphp
                                                {{$counter}}
                                            </th>
                                            <td>{{$ratios['v_name']; }}</td>
                                            <td>{{$ratios['h_name']; }}</td>
                                            <td>{{$ratios['value']; }}</td>
                                            <td>
                                            <a href="{{route('deleteRatioAlternative' , ['criterias_id' =>$ratios['criterias_id'], 'v_id' => $ratios['v_id'], 'h_id' => $ratios['h_id']])}}" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        @else
                                            @continue
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
