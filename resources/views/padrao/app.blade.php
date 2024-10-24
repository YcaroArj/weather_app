@extends('welcome')

@section('title', 'Página Inicial')

@section('content')
    <div class="flex flex-col">
        <img class="h-[250px]" src="{{ asset('img/search_img.svg') }}" alt="">
        <div class="text-orange-500">
            <h1 class="text-center text-2xl font-bold ">Digite o nome da cidade</h1>
            <p class="text-center text-xl ">Descubra as condições climáticas da qualquer cidade brasileira</p>
        </div>
    </div>
@endsection
