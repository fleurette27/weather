<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;
use Exception;
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

        try {
            $weather = $this->weatherService->getWeatherByCity($city);

            if ($weather) {
                return view('welcome', compact('weather', 'city'));
            } else {
                return redirect()->back()->withErrors(['city' => 'Ville non trouvée ou problème avec l\'API.']);
            }
        } catch (Exception $e) {
            // En cas d'erreur, capturer l'exception et renvoyer un message d'erreur
            return redirect()->back()->withErrors(['city' => 'Une erreur s\'est produite: ' . $e->getMessage()]);
        }
    }
}

