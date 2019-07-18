<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends Controller
{
    public function index(Request $request){
        // 创建一个查询构造器
        $builder = Product::where('on_sale' , true);
        // 判断是否有提交 search 参数，如果有就赋值给 $search 变量
        // search 参数用来模糊搜索商品
        if ($search = $request->search){
            $link = '%' . $search . '%';
            // 模糊搜索商品标题、商品详情、SKU 标题、SKU描述
            $builder->where(function($query) use ($link){
                $query->where('title','like' , $link)
                    ->orWhere('description','like',$link)
                    ->orWhereHas('skus',function($query) use ($link){
                       $query->where('title','like',$link)
                            ->orWhere('description','like',$link);
                    });
            });
        }

        // 是否有提交 order 参数，如果有就赋值给 $order 变量
        // order 参数用来控制商品的排序规则
        if ($order = $request->order){
            // 是否是以 _asc 或者 _desc 结尾
            if (preg_match('/^(.+)_(asc|desc)$/',$order , $m)){
                // 如果字符串的开头是这 3 个字符串之一，说明是一个合法的排序值
                if (in_array($m[1] , ['price','sold_count' , 'rating'])){
                    $builder->orderBy($m[1],$m[2]);
                }
            }
        }
        $product = $builder->paginate(8);

//        dd(\Storage::disk('public')->url('aaaa'));
        return view('products.index',[
            'products'=>$product,
            'filters'  => [
                'search' => $search,
                'order'  => $order,
            ]
        ]);
    }

    //
}