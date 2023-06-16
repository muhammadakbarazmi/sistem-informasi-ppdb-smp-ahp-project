@extends('guru.layouts.app')

@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perangkingan Siswa</h1>
    </div>

    <div class="row justify-content-center">
        <!-- Content Row -->
        <div class="row">
        
            <div class="col-auto mb-auto">
                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Hasil Perhitungan AHP</h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Rank</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Poin</th>
                                <th scope="col">Persentase</th>

                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($data->rank) --}}
                                @foreach ($data->rank as $rank => $value)
                                @if ($rank == 'totalpoins')
                                    @continue
                                @else
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td >{{$rank}}</td>
                                    <td >{{round($value,3)}}</td>
                                    <td >{{round(($value/$data->rank['totalpoins']) * 100 ,1)}} %</td>
                                </tr>
                                @endif
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

@section('js')
    <script>
    $(document).on("click", "#button-edit", function () {
     var raw = $(this).attr('data-modal');
     var datas = JSON.parse(raw);
        console.log(datas);
    $(".modal-body #id-gaji").attr("value", datas.id);
    $(".modal-body #inputNamaBonus").val(datas.name);
    $(".modal-body #bonusOption").find("option").each(function(){
            if ($(this).text() == datas.bonus_name){
                $(this).attr("selected","selected");
            }
        });
    $(".modal-body #inputGaji").val(datas.value);
    });

    $(document).on("click", "#button-edit-bonus", function () {
     var raw = $(this).attr('data-modal');
     var datas = JSON.parse(raw);
    $(".modal-body #id-bonus").attr("value", datas.id);
    $(".modal-body #inputNama").val(datas.name);
    $(".modal-body #inputBonus").val(datas.value);
    });

    $('#bonusOption').on('change', function() {
        var karyawan = $(this).find(":selected").text();

    });
  </script>
@endsection
