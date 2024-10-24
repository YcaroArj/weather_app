@extends('welcome')

@section('title', 'Página Inicial')

@section('content')
    <div class="flex flex-col">
        <img class="h-[250px]" src="{{ asset('img/404_error.svg') }}" alt="">
        <div class="text-orange-500">
            <h1 class="text-center text-2xl font-bold ">Erro ao encontrar cidade</h1>
            <p class="text-center text-xl ">Por favor, verifique e tente novamente.</p>
        </div>
    </div>
@endsection
