<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helper\ResponseHelper;

class CategoryController extends Controller
{
    public function CategoryList(){
        $data = Category::all();
        return ResponseHelper::Out('Success', $data, 200);
    }
}
