<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Policy;
use App\Helper\ResponseHelper;

class PolicyController extends Controller
{
    public function PolicyByType(Request $request){
        $data = Policy::where('type', '=', $request->type)->first();
        return $data;
    }
}
