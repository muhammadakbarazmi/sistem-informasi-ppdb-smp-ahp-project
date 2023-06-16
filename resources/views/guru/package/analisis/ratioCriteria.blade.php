{{-- @dd($data) --}}
@extends('guru.layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perbandingan Kriteria</h1>
    </div>

    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">List Perbandingan Kriteria </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            @foreach ($data->matrix as $key => $props)
                            @if ($key != 'sumCol')
                            <th class="text-center" scope="col">{{ $key;  }}</th>
                            @endif
                            @endforeach
                            <th class="text-center"  scope="col">Edit</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data->matrix as $key => $value)
                        <tr>
                            @if ($key != 'sumCol')
                            <th scope="col">{{ $key; }}
                                @else
                                <th scope="col">Jumlah
                            @endif
                            @foreach ($value as $keys => $values)
                                    <td class="text-center" >{{  $values; }}</td>
                                    @if($key != 'sumCol' and $loop->last)
                                    <td  class="text-center">
                                        <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#exampleModal" data-whatever="{{json_encode($value)}}" data-title="{{$key}}">
                                            <i class="fas fa-pen"></i></button>
                                    </td>
                                    @endif
                            @endforeach
                        </th>
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-lg-12 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Eigen Table </h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                            @foreach ($data->eigen as $key => $props)
                            @if ($key == 'sumEigen')
                            <th class="text-center" scope="col">Tot. Eigen</th>
                            <th class="text-center" scope="col">Avg. Eigen</th>
                            @else
                            <th class="text-center" scope="col">{{ $key;  }}</th>
                            @endif
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->eigen as $keyName => $value)
                        <tr>
                            @if ($keyName != 'sumEigen')
                                <th scope="col">{{ $keyName; }}
                            @else
                                <th scope="col">Jumlah
                            @endif
                                    @foreach ($value as $key => $valueMatrix)
                                    @if ($key == 'totalEigen')
                                    <td class="text-center" >{{  round($valueMatrix, 3); }}</td>
                                    <td class="text-center" >{{  round( $valueMatrix / $data->eigen['sumEigen']['totalEigen'], 3); }}</td>
                                    @else
                                    <td class="text-center" >{{  round($valueMatrix, 3); }}</td>
                                    @endif
                                    @endforeach
                            </th>
                        </tr>
                        @endforeach
                        <tr class="text-center">
                            <td colspan='{{(count($data->eigen) + 1)}}'>Lamda Max</td>
                            <td colspan='1'>{{round($data->lamda['sumLamda'], 5)}}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan='{{(count($data->eigen) + 1)}}'>IR Variable</td>
                            <td colspan='1'>{{round($data->lamda['IR'], 2)}}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan='{{(count($data->eigen) + 1)}}'>Consistency Index (CI)</td>
                            <td colspan='1'>{{round($data->lamda['CI'], 5)}}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan='{{(count($data->eigen) + 1)}}'>Consistency Ratio = CI / IR</td>
                            <td colspan='1'>{{round($data->lamda['constant'], 5)}}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan='{{(count($data->eigen) + 1)}}'>Consistency Status</td>
                            <td colspan='1'>
                                @if ($data->lamda['constant'] < 0.1)
                                Consistent
                                @else
                                inConsistent
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="{{route('massRatioCriteria')}}" method="POST">
            @csrf
            <div class="modal-body">
                <input id="_rowCriteria" type="text" name="row" hidden>
                @foreach ($data->matrix as $key => $value )
                @if ($key == 'sumCol')
                    @continue
                @endif
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nilai terhadap : {{$key}}</label>
                        <input type="text" class="form-control" id="recipient-name" name="{{$key}}">
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var datas = button.data('whatever') // Extract info from data-* attributes
  var title = button.data('title') // Extract info from data-* attributes

  var modal = $(this)
  modal.find('.modal-title').text('Edit row Data = ' + title)
  modal.find('#_rowCriteria').val(title)
  modal.find('.modal-body input').attr('readonly', false)
  $.each(datas, function (indexInArray, valueOfElement) {
      modal.find('.modal-body input[name="'+ indexInArray + '"]').val(valueOfElement)
      if(valueOfElement == 1){
          modal.find('.modal-body input[name="'+ indexInArray + '"]').attr('readonly', true)
      }

  });
})


</script>


@endsection
