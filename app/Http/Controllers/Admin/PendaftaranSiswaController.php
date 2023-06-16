<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PendaftaranSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Siswa = Siswa::where([
            ['no_peserta', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('nama', 'LIKE', '%' . $term . '%')
                        ->orWhere('no_peserta', 'LIKE', '%' . $term . '%')
                        ->orWhere('alamat', 'LIKE', '%' . $term . '%')
                        ->orWhere('tanggal_lahir', 'LIKE', '%' . $term . '%')
                        ->orWhere('jenis_kelamin', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->simplePaginate(5);

        return view('admin/package/siswa/index', compact('Siswa'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/package/siswa/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_peserta' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'gambar' => 'required'
        ]);

        $photo      = $request->file('gambar');
        $photo_name = time() . '_photo_' . $photo->getClientOriginalExtension();
        $photo_path = $photo->storeAs('fotosiswa', $photo_name, 'public');
        Siswa::create([
            'no_peserta' => $request->no_peserta,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'gambar' => $photo_path,
        ]);

        return redirect()->route('siswa.index')
        ->with('success', 'Data Siswa Berhasil Ditambahkan');
    }


    public function show($id)
    {
        // $Siswa = Siswa::find($id);
        // return view('admin/package/siswa/detail');
    }


    public function edit($id)
    {
        $Siswa = Siswa::find($id);
        // echo json_encode($Siswa);die();
        return view('admin/package/siswa/update', ['Siswa' => $Siswa]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'no_peserta' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'gambar' => 'required'
        ]);
        
        if ($request->gambar && file_exists(storage_path('app/public/' . $request->gambar))) {
            Storage::delete(['public/' . $request->gambar]);
        }
        $image_name = $request->file('gambar')->store('images', 'public');

        $update = Siswa::find($id);
        $update->no_peserta = $request->get('no_peserta');
        $update->nama = $request->get('nama');
        $update->alamat = $request->get('alamat');
        $update->tanggal_lahir = $request->get('tanggal_lahir');
        $update->jenis_kelamin = $request->get('jenis_kelamin');
        $update->gambar = $image_name;

        $update->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('siswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function destroy($id)
    {
        // Fungsi eloquent untuk menghapus data
        Siswa::find($id)->delete();
        return redirect('/admin/siswa')
            ->with('success', 'Data Siswa Berhasil Dihapus');
    }
}