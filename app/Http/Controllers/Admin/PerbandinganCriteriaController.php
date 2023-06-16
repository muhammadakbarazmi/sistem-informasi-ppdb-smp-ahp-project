<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\RatioCriteria;

class PerbandinganCriteriaController extends Controller
{
    public function index()
    {
        try {
            $criteria = Criteria::all()->toArray();
            $ratio    = RatioCriteriaController::data();
            $data = (object)[
                'criteria'  => $criteria,
                'ratio'     => $ratio,
            ];
        } catch (\Throwable $th) {
            $data = null;
        }

        // dd($data);
        return view('admin/package/analisis/criteria')->with('data', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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

    public function massUpdate(Request $request)
    {

        foreach ($request->except(['_token', 'row'])  as $key => $value) {
            $keyID = Criteria::getIdfromName($key);
            $rowID = Criteria::getIdfromName($request->row);
            if($keyID == $rowID){
                continue;
            };
            RatioCriteria::where([
                    ['h_criteria_id', '=', $keyID],
                    ['v_criteria_id', '=', $rowID],
                ])->update([
                    'value' => $value,
                ]);
            RatioCriteria::where([
                    ['h_criteria_id', '=', $rowID],
                    ['v_criteria_id', '=', $keyID],
                ])->update([
                    'value' => (1/$value),
                ]);
        }

        return redirect()->back()->with('message', 'Input Data Sukses');
    }

    public function destroy(Criteria $criteria)
    {
        $existance = RatioCriteria::where('v_criteria_id', $criteria->id)
            ->orWhere('h_criteria_id', $criteria->id)
            ->count();
        if ($existance > 1) {
            return redirect()->back()->with(["message" => "Info : Kriteria memiliki relasi perbandingan!"]);
        } else {
            $criteria->delete();
            return redirect()->back()->with(["message" => "Delete Data sukses"]);
        }
    }
}
