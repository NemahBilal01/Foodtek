<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SpecialOfferController extends Controller
{
    
    //get all the activated discount
    public function index(){

        $today = Carbon::today();

        $offers = SpecialOffer::where('is_active', true)
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->get();

        return response()->json(['offers'=>$offers]);
    }
}
