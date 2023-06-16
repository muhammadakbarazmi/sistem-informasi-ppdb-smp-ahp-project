@extends('admin.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Master Siswa</h1>
<a href="{{ route('siswa.create') }}">
	<button type="button" class="btn btn-primary btn-toastr"><i class="fa fa-plus-square"></i> Tambah Data Siswa</button>
</a>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="m-0 font-weight-bold text-primary">Data Siswa</h5>
	</div>

	<div class="btn plus mr-auto">
		<div class="float-left">
			<form action="{{ route('siswa.index') }}" method="GET" role="search">
				<div class="input-group">
					<a href="{{ route('siswa.index') }}" class="mr-4 mt-1">
						<span class="input-group-btn">
							<button class="btn btn-danger" type="button" title="Refresh page">
								<span class="fas fa-sync-alt">Refresh</span>
							</button>
						</span>
					</a>
					
					<input type="text" class="form-control mr-4 mt-1" name="term" placeholder="Search" id="term">
					<span class="input-group-btn mr-2 mt-1">
						<input type="submit" value="Cari" class="btn btn-primary">
					</span>
				</div>
			</form>
		</div>
	</div>

	<div class="card-body">
		<div class="table-responsive">
		@if ($message = Session::get('success'))
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@endif
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No.</th>
						<th>No. Peserta</th>
						<th>Nama Lengkap</th>
						<th>Alamat</th>
						<th>Tanggal Lahir</th>
						<th>Jenis Kelamin</th>
						<th>Foto</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $no = 1; ?>
					@if($Siswa->count() > 0)
					@foreach($Siswa as $S)
					<tr>
						<td>
							<?php
							echo $no++;
							?>
						</td>
						<td>{{ $S->no_peserta }}</td>
						<td>{{ $S->nama }}</td>
						<td>{{ $S->alamat }}</td>
						<td>{{ $S->tanggal_lahir }}</td>
						<td>{{ $S->jenis_kelamin }}</td>
						<td><img width="90px" src="{{asset('storage/'.$S->gambar)}}" alt=""></td>
						<td>
							<form action="{{ route('siswa.destroy',$S->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa?')">
								<a class="btn btn-info btn-toastr" href="{{ route('siswa.edit',$S->id) }}">Update</a>
								
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Delete</button>
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
@endsection