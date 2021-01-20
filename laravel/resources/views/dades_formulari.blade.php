@extends('layouts.layout')

@section('contingut')

    Fornulari: <a class="float-right" style="color:blue;" href="{{ route('formulari') }}">Tornar</a>

@endsection

@section('contingut2')

    <div class="p-6 bg-white border-b border-gray-200"> 
        L'usuari amb l'email: <b>{{ $mail }}</b>
    </div>

    <div class="p-6 bg-white border-b border-gray-200"> 
        El nif es:  <b>{{ $nif }}</b>
    </div>

    <div class="p-6 bg-white border-b border-gray-200"> 
        El link al arxiu :  <b><a style="color:blue;" href="{{ url($url_fitxer) }}">Link al fitxer</a></b>
    </div>

    <div class="p-6 bg-white border-b border-gray-200"> 
        La imatge :  <b>{{ $url_img }}</b>
        <img src="{{ url($url_img) }}">
    </div>


@endsection
