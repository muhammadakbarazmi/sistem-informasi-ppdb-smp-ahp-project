@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Kriteria</h1>
<a href="/admin/kriteria/form">
	<button type="button" class="btn btn-primary btn-toastr"><i class="fa fa-plus-square"></i> Tambah</button>
</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="m-0 font-weight-bold text-primary">Data Kriteria</h5>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Id Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $no = 1; ?>
					@if($data_kriteria->count() > 0)
					@foreach($data_kriteria as $DK)
					<tr>
						<td>
							<?php
							echo $no++;
							?>
						</td>
						<td>{{ $DK->code }}</td>
						<td>{{ $DK->name }}</td>
						<td>
							<button type="button" class="btn btn-danger btn-circle" > 
								<a href="{{route('hapuskriteria', ['criteria' => $DK['id']])}}" style="color:white;">
									<i class="fas fa-trash"></i>
								</a>
								</button>
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td colspan="6">Data tidak tersedia</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection