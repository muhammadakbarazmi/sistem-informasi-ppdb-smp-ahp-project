@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Sub Kriteria</h1>
<a href="/admin/sub/form">
	<button type="button" class="btn btn-primary btn-toastr"><i class="fa fa-plus-square"></i> Tambah Data Sub Kriteria</button>
</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="m-0 font-weight-bold text-primary">Data Sub Kriteria</h5>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Code Sub Kriteria</th>
						<th>Nama Kriteria</th>
						<th>Nilai Kriteria</th>
						<th>Nilai Bobot</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; ?>
					@if($data_sub->count() > 0)
					@foreach($data_sub as $DS)
					<tr>
						<td>
							<?php
							echo $no++;
							?>
						</td>
						<td>{{ $DS->code }}</td>
						<td>{{ $DS->name }}</td>
						<td>{{ $DS->nilaik }}</td>
						<td>{{ $DS->nilaib }}</td>
						<td>
							<button type="button" class="btn btn-info btn-toastr" href="">
								<a href="/admin/sub/formedit/{{ $DS->id }}" style="color:white;">Update</a>
							</button>
							<button type="button" class="btn btn-danger btn-toastr">
								<a href="/admin/sub/hapussub/{{ $DS->id }}" style="color:white;">Delete</a>
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
	<!-- END MAIN CONTENT -->
</div>
@endsection