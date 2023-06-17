@extends('guru.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Input Data Alternatif Siswa</h1>
    </div>


    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- List Siswa -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Input Data</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('upsertData2')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Name">Pilih Siswa</label>
                            <select id="Name" class="form-control" name="alternative_id">
                                @foreach ($data['alternative'] as $key => $value)
                                <option value="{{$value["id"]}}">{{$value["name"]}}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach ($data['criteria'] as $key => $value)
                        <div class="form-group">
                            <label for="">Nilai {{$value["name"]}} : </label>
                            <input type="text" class="form-control" id="" placeholder="Masukan Nilai" name="{{$value["id"]}}">
                        </div>
                        @endforeach
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-4">
            <!-- List Siswa -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            @foreach ($data['criteria'] as $key => $value)
                                <th>{{$value["name"]}}</th>
                            @endforeach
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($data['listData'] as $name => $prop)
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <th>{{$name}}</th>
                                    @foreach ($data['criteria'] as $keys => $values)
                                        @foreach ($prop as $key => $value)
                                        {{-- @dd($prop) --}}
                                        @if ($values["name"] == $key)
                                        @if ($loop->first)
                                            <td class="text-left"> {{$value}}</td>
                                            @else
                                            <td>{{$value}}</td>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                                        <td>
                                            <a href="{{route('deleteData', ['id' => $prop['siswa_id'] ])}}" class="btn btn-danger btn-circle" >
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Data Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('upsertData')}}" method="POST">
                @csrf
                <input type="text" id="id" name="employe_id" hidden>
                @foreach ($data['criteria'] as $key => $value)
                <div class="form-group">
                    <label for="">Nilai {{$value["name"]}} : </label>
                    <input type="text" class="form-control" placeholder="Masukan Nilai" name="{{$value["id"]}}" required>
                </div>
                @endforeach
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@endsection

@section('js')
    <script>
    $(document).on("click", "#button-edit", function () {
     var raw = $(this).attr('data-modal');
     var datas = JSON.parse(raw);
        console.log(datas);
    $(".modal-body #id").attr("value", datas.id);
    $(".modal-body #inputNama").val(datas.name);
    $(".modal-body #inputJabatan").find("option").each(function(){
            if ($(this).text() == datas.position){
                $(this).attr("selected","selected");
            }
        });
    $(".modal-body #inputGender").find("option").each(function(){
            if ($(this).text() == datas.gender){
                $(this).attr("selected","selected");
            }
        });
    $(".modal-body #inputAlamat").val(datas.address);
    $(".modal-body #inputTanggal").val(datas.date_in);
    });
  </script>
@endsection
