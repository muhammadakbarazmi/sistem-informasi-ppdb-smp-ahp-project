<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\RatioCriteria;

class CriteriaController extends Controller
{
    public function tampilform(){
        return view('admin/package/kriteria/create');
    }

    public function index(){
        $criterias = Criteria::all();
        // return Resource::collection($criterias);

        return view('admin/package/kriteria/index',['data_kriteria' => $criterias]);
    }

    public function tampileditkriteria($id)
    {
        $data_kriteria = DB::table('criterias')->where('id', $id)->get();
        return view('admin/package/kriteria/update', ['data_kriteria' => $data_kriteria]);
    }

    public function postkriteria(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:4|unique:criterias',
            'name' => 'required|string|max:255'
        ]);

        $criteria = Criteria::create($request->all());

        return redirect('/admin/kriteria');
        // dd($request->all());
    }

    public function storeRatio(Request $request)
    {
        $request->validate([
            'v_criteria' => 'required|different:h_criteria',
            'h_criteria' => 'required|different:V_criteria',
            'value' => 'numeric',
        ]);

        if (RatioCriteria::where('v_criteria_id', $request->v_criteria)
                            ->where('h_criteria_id', $request->h_criteria)
                            ->count()
        ) {
            return redirect()->back()->with('message', 'Data Sudah Pernah disimpan');
        }

        RatioCriteria::create(
            [
                'v_criteria_id' => $request->v_criteria,
                'h_criteria_id' => $request->h_criteria,
                'value' => $request->value,
            ]);
        RatioCriteria::create([
                'h_criteria_id' => $request->v_criteria,
                'v_criteria_id' => $request->h_criteria,
                'value' => (1 / $request->value),
            ]);
        return redirect()->back()->with('message', 'Input Data Sukses');
    }

    public function updatekriteria(Request $request, Criteria $criteria)
    {
        $request->validate([
            'code' => 'required|string|max:4|unique:criterias,code,'.$criteria->id,
            'name' => 'required|string|max:255'
        ]);

        $criteria->update($request->all());

        return redirect('/admin/kriteria');
        // dd($request->all());        
    }
    
    public function delskriteria(Criteria $criteria)
    {
        $existance = RatioCriteria::where('v_criteria_id', $criteria->id)
            ->orWhere('h_criteria_id', $criteria->id)
            ->count();
        if ($existance > 1) {
            return redirect()->back()->with(["error" => "Info : Kriteria memiliki relasi perbandingan!"]);
        } else {
            $criteria->delete();
            return redirect()->back()->with(["success" => "Delete Data sukses"]);
        }
    }
}