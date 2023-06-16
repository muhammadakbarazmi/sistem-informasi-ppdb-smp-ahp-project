<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HasilPerangkinganController extends Controller
{
    public function index()
    {
        $rank = RankController::show();
        $data = (object)[
            'rank' => $rank
        ];
        // dd($data);
        return view('guru/package/analisis/payout')->with('data', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $rank = RankController::show();

        $data = (object)[
            'rank' => $rank
        ];
        // dd($data);
        return view('guru/package/analisis/payout')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payout  $payout
     * @return Redirect Back
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payout  $payout
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //

    }
}

