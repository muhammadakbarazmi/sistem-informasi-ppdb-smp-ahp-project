<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * 
     * @return array
     */
    public static function show()
    {
        $altData = RatioAlternativeController::showAlternative();
        $crtData = RatioCriteriaController::generate();
        $result = array();
        $resultTotal = 0;
        
        foreach ($crtData->eigen as $nameCrt => $valueCrt ) {
            $avgEigenCrt = $valueCrt['totalEigen'] / (count($valueCrt) - 1);
            if(!array_key_exists($nameCrt ,$altData) or $nameCrt == 'sumEigen'){
                continue;
            }
            foreach ($altData[$nameCrt]['eigen'] as $nameAlt => $valueAlt) {
                if($nameAlt == 'sumEigen'){
                    continue;
                }
                $avgEigenAlt = $valueAlt['totalEigen'] / (count($valueAlt)-1); 
                
                $result[$nameAlt][$nameCrt] = $avgEigenAlt * $avgEigenCrt;
            }
        }

        foreach ($result as $altName => $crtVal) {
            $sum = 0;
            foreach ($crtVal as $key => $value) {
                $sum += $value;
            }
            $result[$altName] = $sum ; 
            $resultTotal += $sum;
            $result['totalpoins'] = $resultTotal ; 
        }
        // asort($result);
        return $result;
    }

}
