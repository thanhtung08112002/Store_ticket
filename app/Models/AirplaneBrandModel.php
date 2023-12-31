<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirplaneBrandModel extends Model
{
    use HasFactory;
    protected $table = 'airplane_brand';
    protected $fillable = ['name', 'information', 'status'];
    protected  $timestamp = true;
}
