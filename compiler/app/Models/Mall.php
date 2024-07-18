<?php

namespace App\Models;
use App\Models\Manager;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];


    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

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
        return ($value == null ? '' : $actual_link . 'images/malls/' . $value);
    }
}
