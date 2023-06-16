<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Siswa = User::all();

        return view('siswa/package/index', compact('Siswa'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswa/package/create');
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
            'name' => 'required',
            'level' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:8',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $photo      = $request->file('gambar');
        $photo_name = time() . '_photo_' . $photo->getClientOriginalExtension();
        $photo_path = $photo->storeAs('fotoUser', $photo_name, 'public');
        User::create([
            'name' => $request->name,
            'level' => $request->level,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
        $User = User::find($id);
        // echo json_encode($Siswa);die();
        return view('siswa/package/update', compact('User'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'gambar' => 'required'
        ]);
        
        if ($request->gambar && file_exists(storage_path('app/public/' . $request->gambar))) {
            Storage::delete(['public/' . $request->gambar]);
        }
        $image_name = $request->file('gambar')->store('images', 'public');

        $update = User::find($id);
        $update->name = $request->get('name');
        $update->level = $request->get('level');
        $update->email = $request->get('email');
        $update->password = $request->get('password');
        $update->alamat = $request->get('alamat');
        $update->tanggal_lahir = $request->get('tanggal_lahir');
        $update->jenis_kelamin = $request->get('jenis_kelamin');
        $update->gambar = $image_name;

        $update->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('siswa.index')
            ->with('success', 'Siswa Berhasil Diupdate');
    }


    public function destroy($id)
    {
        // Fungsi eloquent untuk menghapus data
        User::find($id)->delete();
        return redirect('/user/siswa')
            ->with('success', 'Data Siswa Berhasil Dihapus');
    }
}