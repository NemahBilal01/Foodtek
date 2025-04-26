<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialOffer;
use Illuminate\Support\Carbon;
class SpecialOfferController extends Controller
{
    public function index()
{
    $today = Carbon::today();

    $offers = SpecialOffer::where('is_active', true)
        ->where('start_date', '<=', $today)
        ->where('end_date', '>=', $today)
        ->get();

    return response()->json($offers);
}
}



