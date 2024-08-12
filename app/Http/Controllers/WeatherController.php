<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\WeatherService; // Importez votre service ici

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

        try {
            $weather= $this->weatherService->getWeatherData($city);

            return view('welcome', compact('weather', 'city'));

        } catch (\Exception $e) {
            Log::error('Une exception s\'est produite.', ['exception' => $e->getMessage()]);
            return redirect()->back()->withErrors(['city' => 'Une erreur s\'est produite: ' . $e->getMessage()]);
        }
    }
}
