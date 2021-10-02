<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serie extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=['name','photo','link'];
}
