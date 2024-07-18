<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mall;
class Manager extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $hidden = ['password','created_at','updated_at'];


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
        return ($value == null ? '' : $actual_link . 'images/managers/' . $value);
    }

    public function malls()
    {
        return $this->hasMany(Mall::class);
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::deleting(function($manager){
    //         $manager->malls()->each(function($mall)
    //         {
    //           $mall->delete();
    //         });

    //     });
    // }

}
