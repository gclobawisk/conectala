<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name', 'region', 'country', 'lat', 'lon', 'tz_id', 'localtime'
    ];

    public function weatherData(): HasMany
    {
        return $this->hasMany(WeatherData::class);
    }
}
