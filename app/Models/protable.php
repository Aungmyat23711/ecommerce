<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class protable extends Model
{
    use HasFactory;
    public $table='protable';
    public $timestamps=false;
    protected $fillable=['category','product','price','qty','photo'];
}
