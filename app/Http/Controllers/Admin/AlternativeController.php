<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\RatioAlternative;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function tampilform(){
        return view('admin/package/alternatif/create');
    }

    public function index(){
        $alternatives = Alternative::orderBy('code', 'asc')->get();
        // return AlternativeResource::collection($alternatives);

        return view('admin/package/alternatif/index',['alternatives' => $alternatives]);
    }

    public function postalternatif(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:4|unique:alternatives',
            'name' => 'required|string|max:255'
        ]);

        $alternative = Alternative::create($request->all());

        return redirect('/admin/alternatif');
        
        // dd($request->all());
    }

    public function tampileditalternatif($id)
    {
        $alternatives = DB::table('Alternatives')->where('id', $id)->get();
        return view('admin/package/alternatif/update', ['alternatives' =>  $alternatives]);
    }

    public function updatealternatif(Request $request)
    {
        $data = Alternative::find($request->id);
        if($data){
            $data->update([
                'name' => $request->name,
                ]);
        }

        return redirect('/admin/alternatif')
        ->with(["success" => $request->name]);;      
    }

    public function delalternatif(Alternative $alternative){
        $existance = RatioAlternative::where('h_alternative_id', $alternative->id)
                                      ->orWhere('v_alternative_id', $alternative->id)
                                      ->count();
        if ($existance > 1){
            return redirect()->back()->with(["error" => "Info : Karyawan memiliki relasi perbandingan!"]);
        }else {
            $alternative->delete();
            return redirect()->back()->with(["success" => "Delete Data sukses"]);
        }
    }
}
