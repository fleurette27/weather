<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function showWeather(Request $request)
    {
        $request->validate([
            'city' => 'required|string'
        ]);

        $city = $request->input('city');
        $weather = $this->weatherService->getWeatherByCity($city);

        if ($weather) {
            return view('weather', compact('weather', 'city'));
        }

        return redirect()->back()->withErrors(['city' => 'Ville non trouvée ou problème avec l\'API.']);
    }
}

