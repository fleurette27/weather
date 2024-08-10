<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    protected $apiKey;
    protected $geoUrl = 'http://api.openweathermap.org/geo/1.0/direct';
    protected $weatherUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function __construct()
    {
        $this->apiKey = env('WEATHER_API_KEY');
    }

    public function getCoordinatesByCity(string $city)
    {
        $response = Http::get($this->geoUrl, [
            'q' => $city,
            'limit' => 1,
            'appid' => $this->apiKey
        ]);

        if ($response->successful() && !empty($response->json())) {
            $data = $response->json()[0];
            return [
                'lat' => $data['lat'],
                'lon' => $data['lon']
            ];
        }

        return null;
    }

    public function getWeatherByCoordinates(float $lat, float $lon)
    {
        $response = Http::get($this->weatherUrl, [
            'lat' => $lat,
            'lon' => $lon,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'fr'
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getWeatherByCity(string $city)
    {
        $coordinates = $this->getCoordinatesByCity($city);

        if ($coordinates) {
            return $this->getWeatherByCoordinates($coordinates['lat'], $coordinates['lon']);
        }

        return null;
    }
}
