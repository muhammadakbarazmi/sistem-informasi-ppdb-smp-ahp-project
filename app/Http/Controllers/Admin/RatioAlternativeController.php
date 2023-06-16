<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;
use App\Models\RatioAlternative;
use App\Http\Controllers\Admin\RatioCriteriaController;

class RatioAlternativeController extends Controller
{
    const IR = array(
        0.01,
        0.58,
        0.90,
        1.12,
        1.24,
        1.32,
        1.41,
    );

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $alternative = Alternative::select('id', 'name')->get()->toArray();
            $criteria = Criteria::all()->toArray();
            $ratio = RatioAlternative::join('criterias', 'ratio_alternatives.criteria_id', '=', 'criterias.id')
                ->join('alternatives as v_alternatives', 'ratio_alternatives.v_alternative_id', '=', 'v_alternatives.id')
                ->join('alternatives as h_alternatives', 'ratio_alternatives.h_alternative_id', '=', 'h_alternatives.id')
                ->select('ratio_alternatives.value', 'v_alternatives.name as v_name', 'h_alternatives.name as h_name', 'criterias.name as criterias_name', 'criterias.id as criterias_id', 'v_alternatives.id as v_id', 'h_alternatives.id as h_id')
                ->get()->toArray();
            $data = (object)[
                'alternative' => $alternative,
                'criteria' => $criteria,
                'ratio' => $ratio,
            ];
        } catch (\Throwable $th) {
            return redirect('criteria')->with(['message' => 'data belum lengkap']);
            $data = null;
        }
        //  dd($ratio);

        return view('admin/package/analisis/alternative')->with('data', $data);
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
            'criteria' => 'required',
            'v_alternative' => 'required|different:h_alternative',
            'h_alternative' => 'required|different:v_alternative',
            'value' => 'numeric',
        ]);

        if (RatioAlternative::where('v_alternative_id', $request->v_alternative)
            ->where('h_alternative_id', $request->h_alternative)
            ->where('criteria_id', $request->criteria)
            ->count()
        ) {
            return redirect()->back()->with('message', 'Data Sudah Pernah disimpan');
        }

        RatioAlternative::create([
            'criteria_id' => $request->criteria,
            'v_alternative_id' => $request->v_alternative,
            'h_alternative_id' => $request->h_alternative,
            'value' => $request->value,
        ]);

        RatioAlternative::create([
            'criteria_id' => $request->criteria,
            'h_alternative_id' => $request->v_alternative,
            'v_alternative_id' => $request->h_alternative,
            'value' => (1 / $request->value),
        ]);
        return redirect()->back()->with('message', 'Input Data Sukses')->withInput();
    }

    /**
     * Display the matrix resource.
     *
     * @return array
     */
    public static function showAlternative()
    {
        $alternative = alternative::all();
        $criteria = Criteria::all();
        $matrix = array();
        $altMatrix = array();
        foreach ($criteria as $criterias) {
            $matrix = [];
            foreach ($alternative as $alternatives) {
                $column = $alternatives['id'];
                $nameColumn = $alternatives['name'];
                $validate_exist = RatioAlternative::where(function ($query) use ($column) {
                    $query->where('v_alternative_id', $column)
                        ->orWhere('h_alternative_id', $column);
                })
                    ->where('criteria_id', $criterias['id'])
                    ->count();
                if ($validate_exist < 1) {
                    continue;
                }
                foreach ($alternative as $dataalternatives) {
                    $row = $dataalternatives['id'];
                    $nameRow = $dataalternatives['name'];
                    $dataRatio = RatioAlternative::where('v_alternative_id', $column)
                        ->where('h_alternative_id', $row)
                        ->where('criteria_id', $criterias['id']);

                    if ($column == $row) {
                        $value = 1;
                    } else if ($dataRatio->count() == 0) {
                        continue;
                    }

                    if ($column != $row) {
                        $value = $dataRatio->select('value')->first();
                        $value = $value->value;
                    }
                    $matrix[$nameRow][$nameColumn] = $value;
                }
            }
            foreach ($matrix as $columnName => $columnVal) {
                $devider = RatioCriteriaController::sumMatrix($columnVal);

                foreach ($columnVal as $valueName => $valueMatrix) {
                    $count =  $valueMatrix / (int)$devider;
                    $eigen[$columnName][$valueName] =  $count;
                }
                $matrix[$columnName] = array_merge($columnVal, array('sumCol' => $devider));
            }
            // dd(RatioCriteriaController::reverseMatrix($matrix));
            if ($validate_exist) {
                $altMatrix[$criterias['name']]['ratio'] = RatioCriteriaController::reverseMatrix($matrix);
                $altMatrix[$criterias['name']]['eigen'] = RatioCriteriaController::eigen($altMatrix[$criterias['name']]['ratio']);
            }
        }

        foreach ($altMatrix as $criteriaName => $value) {
            $lamda[$criteriaName] = RatioCriteriaController::lamda($value['ratio']['sumCol'], $value['eigen']);
            $altMatrix[$criteriaName]['lamda'] = $lamda[$criteriaName];
        }

        return $altMatrix;
    }


    public function massUpdate(Request $request)
    {
        foreach ($request->except(['_token', 'criteria', 'alternative'])  as $key => $value) {
            $keyID = alternative::getIdfromName($key);
            $crtID = Criteria::getIdfromName($request->criteria);
            $altID = alternative::getIdfromName($request->alternative);
            if ($keyID == $altID) {
                continue;
            };
            RatioAlternative::where([
                ['criteria_id', '=', $crtID],
                ['v_alternative_id', '=', $keyID],
                ['h_alternative_id', '=', $altID],
            ])->update([
                'value' => (1 / $value),
            ]);
            RatioAlternative::where([
                ['criteria_id', '=', $crtID],
                ['v_alternative_id', '=', $altID],
                ['h_alternative_id', '=', $keyID],
            ])->update([
                'value' => $value,
            ]);
        }

        return redirect()->back()->with('message', 'Input Data Sukses');
    }

    public function destroy($criterias_id, $v_id, $h_id)
    {

        $ratio = RatioAlternative::where('criteria_id', $criterias_id)
            ->where("v_alternative_id", $v_id)
            ->where("h_alternative_id", $h_id)->first();
        $reverseratio = RatioAlternative::where('criteria_id', $criterias_id)
            ->where("v_alternative_id", $h_id)
            ->where("h_alternative_id", $v_id)->first();

        $ratio->delete();
        $reverseratio->delete();

        return redirect()->back()->with(["message" => "delet data perbanfdingan " . $ratio->value . " dan " . $reverseratio->value]);
    }
}

