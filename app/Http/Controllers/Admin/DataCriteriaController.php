<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\DataCriteria;
use App\Models\Alternative;

class DataCriteriaController extends Controller
{
    public function index()
    {
        $alternative = Alternative::all()->toArray();
        $criteria = Criteria::all()->toArray();
        $data_criteria = DataCriteria::leftJoin('alternatives', 'alternatives.id', '=', 'data_criterias.alternative_id')
                                        ->leftJoin('criterias', 'criterias.id', '=', 'data_criterias.criteria_id')
                                        ->select('data_criterias.*' , 'alternatives.name as siswa','alternatives.id as siswa_id', 'criterias.name as kriteria')->get();
        $listData = array();
        foreach ($data_criteria as $key => $value) {
            $nama = $value['siswa'];
            $kriteria = $value['kriteria'];
            $listData[$nama][$kriteria] = $value['value'];
            $listData[$nama]['siswa_id'] = $value['siswa_id'];
        };
        // dd($listData);
        $data = [
            'alternative' => $alternative ,
            'criteria' => $criteria ,
            'listData' => $listData
        ];


        return view('admin/package/analisis/index')->with('data', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        foreach ($request->except(['_token', 'alternative_id']) as $key => $value) {
            DataCriteria::updateOrCreate(
                ['alternative_id' => $request->alternative_id, 'criteria_id' => $key],
                ['value' => $value]
            );
        };

        return redirect()->back()->with('message', 'Input Data Sukses');
    }

    public function destroy( $id)
    {

        DataCriteria::where('alternative_id', $id)->delete();

        return redirect()->back()->with('message', 'Delete Data Sukses');
    }
}
