<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $User = User::where([
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('email', 'LIKE', '%' . $term . '%')
                        ->orWhere('alamat', 'LIKE', '%' . $term . '%')
                        ->orWhere('tanggal_lahir', 'LIKE', '%' . $term . '%')
                        ->orWhere('jenis_kelamin', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
            ->orderBy('id', 'asc')
            ->simplePaginate(5);

        return view('admin/package/user/index', compact('User'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/package/user/create');
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
            'password' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'gambar' => 'required'
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

        return redirect()->route('user.index')
        ->with('success', 'Data User Berhasil Ditambahkan');
    }


    public function show($id)
    {
        // $User = User::find($id);
        // return view('admin/package/User/detail');
    }


    public function edit($id)
    {
        $User = User::find($id);
        // echo json_encode($User);die();
        return view('admin/package/user/update', compact('User'));
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
        return redirect()->route('user.index')
            ->with('success', 'User Berhasil Diupdate');
    }

    public function destroy($id)
    {
        // Fungsi eloquent untuk menghapus data
        User::find($id)->delete();
        return redirect('/admin/user')
            ->with('success', 'Data User Berhasil Dihapus');
    }
}
