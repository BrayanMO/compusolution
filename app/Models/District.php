<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{

    protected $fillable = ['name', 'city_id'];

    use HasFactory;

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
