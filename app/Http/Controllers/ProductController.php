<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSlider;
use App\Models\ProductDetails;
use App\Models\ProductReview;
use App\Helper\ResponseHelper;

class ProductController extends Controller
{
    public function ListProductByCategory(Request $requset){
        $data = Product::where('category_id', $requset->id)->with('category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductByRemark(Request $request){
        $data = Product::where('remark', $request->remark)->with('brand', 'category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductByBrand(Request $request){
        $data = Product::where('brand_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListProductSlider(Request $request){
        $data = ProductSlider::all();
        return ResponseHelper::Out('Success', $data, 200);
    }
    public function ProductDetailById(Request $request){
        $data = ProductDetails::where('product_id', $request->id)->with('product', 'product.brand', 'product.category')->get();
        return ResponseHelper::Out('Success', $data, 200);
    }

    public function ListReviewByProduct(Request $request){
        $data = ProductReview::where('product_id', $request->product_id)->with([
            'profile'=>function($query){
                $query->select('id','cus_name');
            }])->get();
        return ResponseHelper::Out('Success', $data, 200);
    }
}
