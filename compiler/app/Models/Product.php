<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;
use App\Models\VendorProduct;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['created_at','updated_at'];


    public static function saveImage($photo,$folder)
    {
       $photo->store('/',$folder);
       $filename = $photo->hashName();
    //    $path = 'images/'.$folder.'/'.$filename;
       return $filename;

    }

    public function getPhotoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS'])? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/products/' . $value);
    }

    public function Vendors()
    {
        return $this->belongsToMany(Vendor::class,'vendor_products','product_id','vendor_id');
    }

    public function realedvendor()
    {
        return $this->hasMany(VendorProduct::class,'product_id','id');
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::deleting(function($product){
    //         $product->realedvendor()->each(function($realedvendor)
    //         {
    //           $realedvendor->delete();
    //         });

    //     });
    // }
}
