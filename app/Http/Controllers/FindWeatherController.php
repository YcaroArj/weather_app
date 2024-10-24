<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Services\BaseService;
use Illuminate\Http\Request;

class FindWeatherController extends Controller
{
    public function view()
    {
        return view('padrao.app');
    }

    public function findWeather(Request $request)
    {
        $response = $request->all();
        $city = $response['city'];

        return redirect()->route('weather.view', ['city' => $city]);
    }

    public function viewWeather($city)
    {
        $apiService = new ApiService();
        $baseService = new BaseService();

        $dados = $apiService->searchCityData($city);
        $dailyForecast = $apiService->dailyForecast($city);
        $weekForecast = $apiService->weekForecast($city);

        if ($dados === null || $dailyForecast === null) {
            return redirect()->route('city.not.found');
        }

        $date = date('d/m/Y');
        $codeIcon = $dados['weather'][0]['icon'];

        $icon = $apiService->getIcon($codeIcon);

        $array = [
            'description' => ucfirst($dados['weather'][0]['description']),
            'temperature' => number_format($dados['main']['temp']) . '°C',
            'humidity' => $dados['main']['humidity'] . '%',
            'windSpeed' => $dados['wind']['speed'] . ' m/s',
            'icon' => $icon,
            'city' => $dados['name']
        ];


        $arrayForecast = [];
        foreach ($dailyForecast as $item) {
            $period = (\Carbon\Carbon::createFromTimestamp($item['dt'])->format('H') < 12) ? 'AM' : 'PM';

            $codeIcon = $item['weather'][0]['icon'];

            $hour = \Carbon\Carbon::createFromTimestamp($item['dt']);
            if ($hour->format('H') >= 18) {
                $codeIcon = str_replace('d', 'n', $codeIcon);
            }

            $dateTxt = $item['dt_txt'];

            $iconForecast = $apiService->getIcon($codeIcon);
            $dayOfWeek = $baseService->dayOfWeek($dateTxt);

            $arrayForecast[] = [
                'dayOfWeek'=> $dayOfWeek,
                'temperature' => number_format($item['main']['temp']) . '°',
                'time' => $hour->format('H:i') . ' ' . $period,
                'icon' => $iconForecast,
            ];
        }

        $arrayWeekForecast = [];
        foreach($weekForecast as $item){
            $period = (\Carbon\Carbon::createFromTimestamp($item['dt'])->format('H') < 12) ? 'AM' : 'PM';
            $date = \Carbon\Carbon::parse($item['dt_txt'])->format('d/m');
            $codeIcon = $item['weather'][0]['icon'];

            $dateTxt = $item['dt_txt'];

            $iconForecast = $apiService->getIcon($codeIcon);
            $dayOfWeek = $baseService->dayOfWeek($dateTxt);
            $arrayWeekForecast[] = [
                'date' => $date,
                'dayOfWeek'=> ucfirst($dayOfWeek),
                'description' => ucfirst($item['weather'][0]['description']),
                'temperature' => number_format($item['main']['temp']) . '°',
                'icon' => $iconForecast,
            ];
        }

        return view('weather.app', compact('array', 'arrayForecast', 'arrayWeekForecast'));
    }
}
