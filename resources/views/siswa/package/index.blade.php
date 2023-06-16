@extends('siswa.layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Profil Siswa</h1>
	<div class="row justify-content-center">
        <div class="col-md-8">
			<!-- DataTales Example -->
			<div class="card shadow mb-4">
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle" width="200px" src="{{ asset('storage/'. Auth::user()->gambar) }}" alt="User profile picture">
						</div>
						<br>
						<h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

						<p class="text-muted text-center">{{ Auth::user()->email }}</p>

						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Alamat</b> <b class="float-right">{{ Auth::user()->alamat }}</b>
							</li>
							<li class="list-group-item">
								<b>Tanggal Lahir</b> <b class="float-right">{{ Auth::user()->tanggal_lahir }}</b>
							</li>
							<li class="list-group-item">
								<b>Jenis Kelamin</b> <b class="float-right">{{ Auth::user()->jenis_kelamin }}</b>
							</li>
						</ul>

						<a href="{{ route('siswa.edit', Auth::user()->id) }}" class="btn btn-primary btn-block"><b>Update</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection