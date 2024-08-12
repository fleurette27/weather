<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Interfaces\WeatherServiceInterface;

class WeatherService implements WeatherServiceInterface

{
    protected $apiKey;
    protected $geoUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    protected $weatherUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
    }

    public function getWeatherData(string $city):array
    {
        // Get coordinates
        $response = Http::get($this->geoUrl, [
            'q' => $city,
            'limit' => 1,
            'appid' => $this->apiKey
        ]);

        if (!$response->successful()) {
            Log::error('Erreur lors de la récupération des coordonnées.', ['response' => $response->body()]);
            throw new \Exception('Erreur lors de la récupération des coordonnées.');
        }

        $coordinates = $response->json();
        if (empty($coordinates)) {
            throw new \Exception('Ville non trouvée.');
        }

        $data = $coordinates[0];
        $lat = $data['lat'];
        $lon = $data['lon'];

        // Get weather data
        $response = Http::get($this->weatherUrl, [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        if (!$response->successful()) {
            Log::error('Erreur lors de la récupération des données météo.', ['response' => $response->body()]);
            throw new \Exception('Erreur lors de la récupération des données météo.');
        }

        return $response->json();
    }
}
