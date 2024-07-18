<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Product;
use App\Models\VendorProduct;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['created_at','updated_at'];

    public function department()
    {
       return $this->belongsTo(Department::class);
    }

    public static function saveImage($photo,$folder)
    {
       $photo->store('/',$folder);
       $filename = $photo->hashName();
    //    $path = 'images/'.$folder.'/'.$filename;
       return $filename;

    }

    public function getlogoAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS'])? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'images/vendors/' . $value);
    }

    public function Products()
    {
        return $this->belongsToMany(Product::class,'vendor_products','vendor_id','product_id');
    }

    public function realedProducts()
    {
        return $this->hasMany(VendorProduct::class,'vendor_id','id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($vendor){
            $vendor->realedProducts()->each(function($realedProducts)
            {
              $realedProducts->delete();
            });

        });
    }


}
