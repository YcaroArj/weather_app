<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class apiService
{
    protected $API_KEY;
    protected $URL_BASE;

    public function __construct()
    {
        $this->API_KEY = config('services.openweathermap.api_key');
        $this->URL_BASE = '';
    }

    public function searchCityData($city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
            'q' => $city . ',br',
            'appid' => $this->API_KEY,
            'lang' => 'pt_br',
            'units' => 'metric'
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }

    public function dailyForecast($city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'q' => $city . ',br',
            'appid' => $this->API_KEY,
            'lang' => 'pt_br',
            'units' => 'metric'
        ]);

        if ($response->failed()) {
            return null;
        }

        $dados = $response->json();
        $previsoes = array_slice($dados['list'], 0, 6);
        return  $previsoes;
    }

    public function weekForecast($city)
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
            'q' => $city . ',br',
            'appid' => $this->API_KEY,
            'lang' => 'pt_br',
            'units' => 'metric'
        ]);

        if ($response->failed()) {
            return null;
        }

        $dados = $response->json();
        $dailyData = [];

        foreach ($dados['list'] as $item) {

            $date = \Carbon\Carbon::parse($item['dt_txt'])->format('Y-m-d');
            $time = \Carbon\Carbon::parse($item['dt_txt'])->format('H:i:s');

            if ($time === '12:00:00') {
                if (!isset($dailyData[$date])) {
                    $dailyData[$date] = $item;
                }
            }
        }


        return array_values($dailyData);
    }

    public function getIcon($codeIcon)
    {
        switch ($codeIcon) {
            case "01d":
                return 'sun';

            case "02d":
                return 'sun_clouds';

            case "03d":
            case "04d":
                return 'clouds';

            case "03n":
            case "04n":
                return 'clouds';

            case "09d":
            case "09n":
                return 'rain';

            case "10d":
                return 'sun_rain';

            case "10n":
                return 'moon_rain';

            case "11d":
            case "11n":
                return 'storm';

            case "13d":
            case "13n":
                return 'snowflake';

            case "50d":
            case "50n":
                return 'mist';

            case "01n":
                return 'full_moon';

            case "02n":
                return 'moon_clouds';

            default:
                return 'default';
        };
    }
}
