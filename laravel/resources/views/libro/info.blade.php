@extends('layouts.layout')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@section('contingut')

<b>Llibre:</b> <a class="float-right" style="color:blue;" href="{{ route('crud') }}">Tornar</a>

@endsection

@section('contingut2')

    @if (count($errors) > 0)
    <div class="p-6 bg-white border-b border-gray-200"> 
        <div class="alert alert-danger">
            <p>Corrige los siguientes errores:</p>
            <br>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="p-6 bg-white border-b border-gray-200"> 
        <h2 style="color:blue;">Llibre num: {{ $libro->id }}</h2><br>
        <li>Nom: {{ $libro->nombre }}</li>
        <li>Resum: {{ $libro->resumen }}</li>
        <li>NPagines: {{ $libro->npagina }}</li>
        <li>Edicio: {{ $libro->edicion }}</li>
        <li>Autor: {{ $libro->autor }}</li>
        <li>Preu: {{ $libro->precio }}€</li>
    </div


@endsection