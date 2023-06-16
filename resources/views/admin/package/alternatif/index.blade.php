@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Alternatif</h1>
<a href="/admin/alternatif/form">
	<button type="button" class="btn btn-primary btn-toastr"><i class="fa fa-plus-square"></i> Tambah</button>
</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="m-0 font-weight-bold text-primary">Data Alternatif</h5>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>Id Alternatif</th>
						<th>Nama Alternatif</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $no = 1; ?>
					@if($alternatives->count() > 0)
					@foreach($alternatives as $DK)
					<tr>
						<td>
							<?php
							echo $no++;
							?>
						</td>
						<td>{{ $DK->code }}</td>
						<td>{{ $DK->name }}</td>
						<td>
							<button id="button-edit" class="btn btn-info btn-circle" >
								<a href="/admin/alternatif/formedit/{{ $DK->id }}" style="color:white;">
									<i class="fas fa-pencil-alt"></i>	
								</a>
							</button>
							<button type="button" class="btn btn-danger btn-circle" >               
								<a href="/admin/alternatif/hapusalternatif/{{ $DK->id }}" style="color:white;">
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