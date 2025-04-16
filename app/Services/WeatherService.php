<?php

namespace App\Services;

use App\Models\Location;
use App\Models\WeatherData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\Weather;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;


    public function __construct()
    {
        $this->apiKey = env('weather_api_key');
        $this->baseUrl = 'https://api.weatherapi.com/v1/current.json';
    }

    public function fetchWeatherData(string $city)
    {
        $response = Http::get($this->baseUrl, [
            'key' => $this->apiKey,
            'q'   => $city,
            'lang' => 'pt'
        ]);

        if ($response->failed()) {
            throw new \Exception('Erro ao consultar a API de clima');
        }

        $data = $response->json();

        DB::beginTransaction();

        try {
            $location = Location::updateOrCreate(
                ['name' => $data['location']['name'], 'lat' => $data['location']['lat'], 'lon' => $data['location']['lon']],
                [
                    'region' => $data['location']['region'],
                    'country' => $data['location']['country'],
                    'tz_id' => $data['location']['tz_id'],
                    'localtime' => $data['location']['localtime']
                ]
            );

            $current = $data['current'];

            $location->weatherData()->create([
                'last_updated' => $current['last_updated'],
                'temp_c' => $current['temp_c'],
                'temp_f' => $current['temp_f'],
                'is_day' => $current['is_day'],
                'condition_text' => $current['condition']['text'],
                'condition_icon' => $current['condition']['icon'],
                'wind_kph' => $current['wind_kph'],
                'humidity' => $current['humidity'],
                'cloud' => $current['cloud'],
                'feelslike_c' => $current['feelslike_c'],
                'uv' => $current['uv']
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Dados meteorológicos salvos com sucesso',
                'location' => $location->name,
                'last_updated' => $current['last_updated']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            // Registrar o erro no log
            Log::error('Erro ao salvar dados meteorológicos: ', [
                'city' => $city,
                'error_message' => $e->getMessage(),
                // 'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Erro ao salvar dados meteorológicos',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    
}
