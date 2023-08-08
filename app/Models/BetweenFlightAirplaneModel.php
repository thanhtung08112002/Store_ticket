<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetweenFlightAirplaneModel extends Model
{
    use HasFactory;
    protected $table = 'between_flight_airplane';
    protected $fillable = ['flight_id','airplane_id'];
    protected  $timestamp = true;
}
