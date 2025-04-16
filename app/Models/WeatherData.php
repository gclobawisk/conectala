<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    protected $fillable = [
        'location_id', 'last_updated', 'temp_c', 'temp_f', 'is_day',
        'condition_text', 'condition_icon', 'wind_kph', 'humidity',
        'cloud', 'feelslike_c', 'uv'
    ];
}
