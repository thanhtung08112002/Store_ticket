<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirplaneModel extends Model
{
    use HasFactory;
    protected $table = 'airplane';
    protected $fillable = ['airplane_name', 'airplane_code', 'airplane_brand_id','qty_seat','status','about'];
    protected  $timestamp = true;
}
