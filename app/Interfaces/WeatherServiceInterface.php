<?php

namespace App\Interfaces;

interface WeatherServiceInterface
{

        /**
         * Récupère les données météo pour une ville donnée.
         *
         * @param string $city Nom de la ville
         * @return array Données météo au format JSON
         * @throws \Exception En cas d'erreur lors de la récupération des données
         */
        public function getWeatherData(string $city): array;
    
}
