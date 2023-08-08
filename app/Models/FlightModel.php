<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightModel extends Model
{
    use HasFactory;
    protected $table = 'flight';
    protected $fillable = ['name', 'location_start', 'location_end','time_start','type_way','information','price','status','image'];
    protected  $timestamp = true;
}
