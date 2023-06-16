<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\RatioCriteria;

class RatioCriteriaController extends Controller
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
            $data = self::generate();

        } catch (\Throwable $th) {
            return redirect('criteria')->with(['message' => "data belum lengkap"]);
            $data = null;
        }
        return view('admin/package/analisis/ratioCriteria')->with('data', $data);
    }

    /**
     *
     * @param array Matrix Source
     * @param array Matrix Eigen
     *
     * @return array Matrix data array
     *
     */

    public static function lamda($arraysumCOl, $arrayEigen)
    {
        $sumCol = $arraysumCOl;
        $avgEigen = array();
        $sumLamda = 0;
        foreach ($arrayEigen as $nameCriteria => $value) {
            if ($nameCriteria == 'sumEigen') {
                continue;
            }
            $dataQuantity = (count($value) - 1);
            $avgEigen[$nameCriteria] = $value['totalEigen'] / $dataQuantity;
            $lamda[$nameCriteria] = $avgEigen[$nameCriteria] * $sumCol[$nameCriteria];
            $sumLamda += $lamda[$nameCriteria];
            $CI = ($sumLamda - $dataQuantity) / ($dataQuantity - 1);
            $constant = $CI / self::IR[$dataQuantity - 2];
        }



        return [
            "avgEigen" => $avgEigen,
            "sumCol" => $sumCol,
            "rawlamda" => $lamda,
            "sumLamda" => $sumLamda,
            "CI" => $CI,
            "constant" =>  $constant,
            "IR" => self::IR[$dataQuantity - 2]
        ];
    }

    public static function generate()
    {
        $matrix    = RatioCriteriaController::showCriteria();
        $eigen     = RatioCriteriaController::eigen($matrix);
        $lamda     = self::lamda($matrix['sumCol'], $eigen);
        $data = (object)[
            'matrix'    => $matrix,
            'eigen'     => $eigen,
            'lamda'     => $lamda
        ];

        return $data;
    }

    /**
     * Show the data from resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function data()
    {
        $data = RatioCriteria::join('criterias as v_criterias', 'ratio_criterias.v_criteria_id', '=', 'v_criterias.id')
            ->join('criterias as h_criterias', 'ratio_criterias.h_criteria_id', '=', 'h_criterias.id')
            ->select('ratio_criterias.value', 'v_criterias.name as v_name', 'h_criterias.name as h_name', 'v_criterias.id as v_id', 'h_criterias.id as h_id')
            ->orderBy('v_name', 'ASC')->get()->toArray();

        return $data;
    }


    /**
     * Display the matrix resource.
     *
     * @return array
     */
    public static function showCriteria()
    {
        $criteria = Criteria::all();
        $matrix = array();
        $eigen = array();
        foreach ($criteria as $matrixColumn) {
            $column = $matrixColumn['id'];
            $nameColumn = $matrixColumn['name'];
            $sumCol = 0;
            $validate_exist = RatioCriteria::Where('v_criteria_id', $column)
                ->orWhere('h_criteria_id', $column)->count();
            if ($validate_exist < 1) {
                continue;
            }
            foreach ($criteria as $matrixRow) {
                $row = $matrixRow['id'];
                $nameRow = $matrixRow['name'];
                $dataRatio = RatioCriteria::where('v_criteria_id', $column)
                    ->where('h_criteria_id', $row);

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
            $devider = self::sumMatrix($columnVal);

            foreach ($columnVal as $valueName => $valueMatrix) {
                $count =  $valueMatrix / (int)$devider;
                $eigen[$columnName][$valueName] =  $count;
            }
            $matrix[$columnName] = array_merge($columnVal, array('sumCol' => $devider));
        }
        return self::reverseMatrix($matrix);
    }

    /**
     * Count Row array data
     *
     * @param  Array
     * @return Array
     */
    public static function eigen($array): array
    {
        $data = array();

        foreach (self::reverseMatrix($array) as $key => $value) {
            $sumEigen = 0;
            $devieder = $value['sumCol'];
            foreach ($value as $name => $eigenVal) {
                if ($name == 'sumCol') {
                    continue;
                }
                $counted = $eigenVal / $devieder;
                $data[$key][$name] = $counted;
                $sumEigen += $counted;
            }
            $data[$key]['sumEigen'] = $sumEigen;
        }

        foreach (self::reverseMatrix($data) as $columnName => $columnVal) {
            $devider = self::sumMatrix($columnVal);

            $data[$columnName] = array_merge($columnVal, array('totalEigen' => $devider));
        }

        return $data;
    }

    /**
     * Count Row array data
     *
     * @param  Array
     * @return interger
     */
    public static function sumMatrix($array)
    {
        $total = 0;
        foreach ($array as $key => $value) {
            $total += $value;
        }

        return $total;
    }


    /**
     * Reverse array data
     *
     * @param  Array
     * @return Array
     */
    public static function reverseMatrix($array)
    {
        $newArray = array();
        foreach ($array as $keyCol => $data) {
            foreach ($data as $keyRow => $value) {
                $newArray[$keyRow][$keyCol] = $value;
            }
        }

        return $newArray;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ratio_criteria  $ratio_criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($v_id, $h_id)
    {

        $ratio = RatioCriteria::where("v_criteria_id", $v_id)
            ->where("h_criteria_id", $h_id)->first();
        $reverseratio = RatioCriteria::where("v_criteria_id", $h_id)
            ->where("h_criteria_id", $v_id)->first();

        $ratio->delete();
        $reverseratio->delete();

        return redirect()->back()->with(["message" => "delet data perbanfdingan " . $ratio->value . " dan " . $reverseratio->value]);
    }
}
