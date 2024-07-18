<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Mosels\Mall;
use App\Mosels\Vendor;
class Department extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function mall()
    {
        return $this->belongsTo(Mall::class);
    }

    public function vendors()
    {
       return $this->hasMany(Vendor::class);
    }

}
