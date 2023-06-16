@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Data User</h1>
<a href="{{ route('user.create') }}">
	<button type="button" class="btn btn-primary btn-toastr"><i class="fa fa-plus-square"></i> Tambah</button>
</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="m-0 font-weight-bold text-primary">Data User</h5>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama Lengkap</th>
					<th>Email</th>
					<th>Level</th>
					<th>Alamat</th>
					<th>Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Foto</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				@if($User->count() > 0)
				@foreach($User as $DU)
				<tr>
					<td>
						<?php
						echo $no++;
						?>
					</td>
					<td>{{ $DU->name }}</td>
					<td>{{ $DU->email }}</td>
					<td>{{ $DU->level }}</td>
					<td>{{ $DU->alamat }}</td>
					<td>{{ $DU->tanggal_lahir }}</td>
					<td>{{ $DU->jenis_kelamin }}</td>
					<td><img width="90px" src="{{asset('storage/'.$DU->gambar)}}" alt=""></td>
					<td>
						<form action="{{ route('user.destroy',$DU->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data user?')">
							<a id="button-edit" class="btn btn-info btn-circle" href="{{ route('user.edit',$DU->id) }}">
								<i class="fas fa-pencil-alt"></i>
							</a>
							
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-circle" type="submit" class="btn btn-danger">
								<i class="fas fa-trash"></i>
							</button>
						</form>
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

</div>
@endsection