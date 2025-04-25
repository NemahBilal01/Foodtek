<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{
    public function index(){
        return SpecialOffer::all();
    }
}
