@extends('welcome')

@section('content')
    <div class="text-white flex flex-row max-xl:flex-col max-xl:items-center">
        <div class="flex flex-col mr-[20px] max-xl:m-0">
            <div class="flex flex-row mb-[20px] max-xl:justify-center">
                <div>
                    <h1 class="text-3xl font-bold">{{ $array['city'] }}</h1>
                    <span>{{ $array['description'] }}</span>
                    <h1 class="text-[3rem] font-bold text-orange-500">{{ $array['temperature'] }}</h1>
                </div>
                <img class="w-[150px] h-[150px] ml-[15vw] max-md:w-[100px] max-md:h-[100px]" src="{{ asset('img/climas/' . $array['icon'] . '.png') }}" </div>
            </div>
            <div class="flex flex-col items-center">
                <div class="w-full bg-gray-700 rounded-xl p-3 max-md:w-full">
                    <h1 class="text-2xl max-md:text-center">Previsão diária</h1>
                    <div class="mt-2 flex flex-row flex-wrap max-md:justify-center">
                        @foreach ($arrayForecast as $item)
                            <div class="flex flex-col items-center w-[100px]">
                                <h1 class="max-md:text-sm">{{ $item['time'] }}</h1>
                                <img class="w-[80px] max-md:w-[50px]" src="{{ asset('img/climas/' . $item['icon'] . '.png') }}"
                                    alt="">
                                <h1 class="font-bold text-2xl max-md:text-sm">{{ $item['temperature'] }}</h1>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full mt-[20px] bg-gray-700 rounded-xl p-3">
                    <h1 class="text-2xl">Condições do Ar</h1>
                    <div class="flex flex-row mt-3">
                        <div>
                            <span class="flex items-center text-gray-300 "><i
                                    class="material-symbols-outlined">device_thermostat</i>
                                Temperatura</span>
                            <h1 class="text-2xl mt-2 font-bold ml-1 max-md:text-sm">{{ $array['temperature'] }}</h1>
                            <span class="flex items-center text-gray-300"><i
                                    class="material-symbols-outlined">water_drop</i>
                                Humidade</span>
                            <h1 class="text-2xl mt-2 font-bold ml-1 max-md:text-sm">{{ $array['humidity'] }}</h1>
                        </div>
                        <div class="ml-[150px]">
                            <span class="flex items-center text-gray-300"><i class="material-symbols-outlined">air</i>
                                Vento</span>
                            <h1 class="text-2xl mt-2 font-bold max-md:text-sm">{{ $array['windSpeed'] }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-white bg-gray-700 rounded-xl p-4 flex flex-col max-xl:mt-[20px]">
            <h1>Previsão dos próximos 5 dias</h1>
            @foreach ($arrayWeekForecast as $item)
                <div class="flex flex-row items-center justify-between py-1">
                    <div class="w-[250px] mr-[30px] flex flex-row justify-between items-center max-md:w-[150px] ">
                        <h1>{{ $item['dayOfWeek'] }}</h1>
                        <img class="w-[100px] max-md:w-[50px]"src="{{ asset('img/climas/' . $item['icon'] . '.png') }}" alt="">
                    </div>
                    <div class="w-[150px] flex flex-row justify-between items-center max-md:text-sm max-md:w-[150px] ">
                        <h1>{{ $item['description'] }}</h1>
                        <h1>{{ $item['date'] }}</h1>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
