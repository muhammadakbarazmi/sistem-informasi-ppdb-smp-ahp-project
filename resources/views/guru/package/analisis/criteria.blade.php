@extends('guru.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perbandingan Kriteria Data</h1>
    </div>

    <div class="row justify-content-center">
        <!-- Content Row -->
        <div class="row">

            <div class="col-lg-12 mb-4">
                <!-- List -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List Perbandingan Kriteria </h6>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 mb-3" method="POST" action="{{route('addRatioCriteria')}}">
                            @csrf
                            <div class="form-group col-4">
                                <select class="form-control" name="v_criteria">
                                    <option selected>Pilih Kriteria</option>
                                    @foreach ($data->criteria as $criteria)
                                        <option value={{ $criteria['id']; }}>{{ $criteria['name']; }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <select class="form-control" name="h_criteria">
                                    <option selected>Pilih Kriteria</option>
                                    @foreach ($data->criteria as $criteria)
                                        <option value={{ $criteria['id']; }}>{{ $criteria['name']; }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="decimal" class="form-control" id="inputCriteria" placeholder="Nilai" name="value">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary mb-3">Tambah</button>
                            </div>
                        </form>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kriteria 1</th>
                                <th scope="col">Kriteria 2</th>
                                <th scope="col">Value</th>
                                <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <p hidden>{{$looping = 1}}</p>
                                {{-- @dd($data->ratio) --}}
                                @foreach ($data->ratio as $ratio)
                                <tr>
                                    <th scope="row">{{$looping++;}}</th>
                                    <td>{{ $ratio['v_name']; }}</td>
                                    <td>{{ $ratio['h_name']; }}</td>
                                    <td>{{ $ratio['value']; }}</td>
                                    <td>
                                        <a href="{{route('deleteRatioCriteria' , ['v_id' => $ratio['v_id'], 'h_id' => $ratio['h_id']])}}" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
