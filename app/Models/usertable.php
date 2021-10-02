<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class usertable extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $table='usertable';
    protected $fillable=['name','password','email','role'];

    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password']=Hash::make($value);
    // }
    // public function setConfirmpassword($vaule)
    // {
    //     $this->attributes['confirmpassword']=Hash::make($value);
    // }
}
