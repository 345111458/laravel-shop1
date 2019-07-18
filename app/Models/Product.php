<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];

    protected $casts = [
        'on_sale'   => 'boolean',
    ];

    public function skus(){

        return $this->hasMany(ProductSku::class);
    }

    public function UserFavoriteProducts(){

        return $this->hasMany(UserFavoriteProducts::class);
    }


    // 图片 访问器
    public function getImageUrlAttribute(){
        // 如果 image 字段本身就已经是完整的 url 就直接返回
        if (Str::startsWith($this->attributes['image'], ['http://', 'https://'])) {
            return $this->attributes['image'];
        }
        return \Storage::disk('public')->url($this->attributes['image']);
    }




    //


}
