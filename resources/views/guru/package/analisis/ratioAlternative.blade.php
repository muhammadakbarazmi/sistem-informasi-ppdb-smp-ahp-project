{{-- @dd($data) --}}
@extends('guru.layouts.app')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Perbandingan Kriteria</h1>
                    </div>
                    @foreach ($data as $criteria => $value)
                    {{-- @dd($value) --}}
                        <div class="row">
                            

                                <div class="col-auto-8 mb-auto">
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">List Perbandingan Kriteria {{$criteria}} </h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    @foreach ($value['ratio'] as $key => $props)
                                                    @if ($key != 'sumCol')
                                                    <th class="text-center" scope="col">{{ $key;  }}</th>
                                                    @endif
                                                    @endforeach
                                                    <th class="text-center" scope="col">Edit</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($value['ratio'] as $key => $prop)
                                                <tr>
                                                    @if ($key != 'sumCol')
                                                    <th scope="col">{{ $key; }}
                                                        @else
                                                        <th scope="col">Jumlah
                                                    @endif
                                                    @foreach ($prop as $keys => $props)
                                                            <td class="text-center" >{{  $props; }}</td>
                                                            @if($key != 'sumCol' and $loop->last)
                                                                <td  class="text-center">
                                                                <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-modal="{{$criteria}}" data-target="#exampleModal" data-whatever="{{json_encode($prop)}}" data-title="{{$key}}">
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

                                <div class="col-lg-8 mb-4">
                                    <!-- Illustrations -->
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">Eigen Table Kriteria {{$criteria}} </h6>
                                        </div>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                    @foreach ($value['eigen'] as $key => $props)

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
                                                @foreach ($value['eigen'] as $keyName => $prop)
                                                <tr>
                                                    @if ($keyName != 'sumEigen')
                                                    <th scope="col">{{ $keyName; }}
                                                    @else
                                                    <th scope="col">Jumlah
                                                    @endif
                                                            @foreach ($prop as $key => $props)
                                                            @if ($key == 'totalEigen')
                                                            <td class="text-center" >{{  round($props, 2); }}</td>
                                                            <td class="text-center" >{{  round( $props / $value['eigen']['sumEigen']['totalEigen'], 3); }}</td>
                                                            @else
                                                            <td class="text-center" >{{  round($props, 2); }}</td>
                                                            @endif
                                                            @endforeach
                                                        </th>
                                                </tr>
                                                @endforeach
                                                <tr class="text-center">
                                                    <td colspan='4'>Principe Eigen Vector</td>
                                                    <td class="text-right" colspan='2'>{{ round($value['lamda']['sumLamda'], 4);}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan='4'>IR Variable</td>
                                                    <td class="text-right" colspan='2'>{{round($value['lamda']['IR'], 2)}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan='4'>Consistency Index</td>
                                                    <td class="text-right" colspan='2'>{{ round($value['lamda']['CI'], 4);}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan='4'>Consistency Ratio = CI / IR</td>
                                                    <td class="text-right" colspan='2'>{{ round($value['lamda']['constant'], 4);}}</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <td colspan='4'>Consistency Status</td>
                                                    <td class="text-right" colspan='2'>
                                                        @if ($value['lamda']['constant'] < 0.1)
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

                    @endforeach
                </div>
                <!-- /.container-fluid -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Kriteria </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{route('massRatioAlternative')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input id="_rowCriteria" type="text" name="criteria" hidden>
                            <input id="_rowAlternative" type="text" name="alternative" hidden>
                            @foreach ($value['ratio'] as $key => $value )
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
  var modal = button.data('modal') // Extract info from data-* attributes

  var viewModal = $(this)
  viewModal.find('.modal-title').text('Edit row Data = ' + title + 'Kriteria ' + modal)
  viewModal.find('#_rowCriteria').val(modal)
  viewModal.find('#_rowAlternative').val(title)
  $.each(datas, function (indexInArray, valueOfElement) {
      viewModal.find('.modal-body input[name="'+ indexInArray + '"]').val(valueOfElement)
      if(valueOfElement == 1){
          viewModal.find('.modal-body input[name="'+ indexInArray + '"]').attr('readonly', true)
      }
  });
})


</script>


@endsection
