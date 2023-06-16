<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function frontendDashboard(Request $request){
        
        return view('frontend.dashboard');
    }

    public function frontendDetail(Request $request){
        
        return view('frontend.detail');
    }

    public function frontendGaleri(Request $request){
        
        return view('frontend.galeri');
    }

    public function frontendRangking(Request $request){
       
        return view('frontend.ranking');
    }
}
