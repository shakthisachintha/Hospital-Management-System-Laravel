<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Medicine;

class MedicineController extends Controller
{
    //

    public function searchSuggestion(Request $request){
        $keyword=$request->keyword;
        return response()->json([
            "sugestion" => ["shakthi","sachinta","blov"],
        ],200);
        
    }
}
