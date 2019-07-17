<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends Controller
{
    public function index(Request $request){

        $product = Product::where('on_sale',true)->paginate(8);

//        dd(\Storage::disk('public')->url('aaaa'));
        return view('products.index',['products'=>$product]);
    }

    //
}
