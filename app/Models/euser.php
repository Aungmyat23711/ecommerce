<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class euser extends Model
{
    use HasFactory;
    public $table='users';
    public $timestamps=false;
}
