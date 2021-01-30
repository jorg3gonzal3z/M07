@extends('layouts.layout')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@section('contingut')

<b>Llibres:</b> <a class="float-right" style="color:blue;" href="{{ route('dashboard') }}">Tornar</a> <a class="float-right pr-3" style="color:blue;" href="{{ route('libro.create') }}">Afegir</a>

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
        @foreach ($libros as $libro)
            <h2 style="color:blue;">Llibre num: {{ $libro->id }}
            <form class="float-right" style="color:red;" action="{{ route('libro.delete',['id' => $libro->id]) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button>Eliminar</button>
            </form>
            <a class="float-right pr-3" style="color:blue;" href="{{ route('libro.show',['id' => $libro->id]) }}">Info</a>
            <a class="float-right pr-3" style="color:blue;" href="{{ route('libro.edit',['id' => $libro->id]) }}">Editar</a> 
            </h2><br>
        @endforeach
    </div


@endsection
