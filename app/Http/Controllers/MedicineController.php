<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Medicine;
use DB;

class MedicineController extends Controller
{
    //

    public function searchSuggestion(Request $request){
        $keyword=$request->keyword;
        return response()->json([
            "sugestion" => ["shakthi","sachinta","blov"],
        ],200);
    }

    public function getherbs(){
        $herbs = DB::table('medicines')->get();
        // dd($herbs);
        return response()->json($herbs);
    }
}
