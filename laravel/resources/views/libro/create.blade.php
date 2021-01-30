@extends('layouts.layout')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@section('contingut')

<b>Afegir Llibre:</b> <a class="float-right" style="color:blue;" href="{{ route('crud') }}">Tornar</a>

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
        <form method="POST" action="{{ route('libro.store') }}">
            
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                    <label >Titol del llibre:</label><br><br>
                    <input type="text" class="form-control " name="nombre" placeholder="Harry Potter..." value="{{ old('nombre') }}">
                </div>
                <br>
                <div class="form-group col-md-4">
                    <label >Resum:</label><br><br>
                    <input type="text" class="form-control " name="resumen" placeholder="Resum del llibre..." value="{{ old('resumen') }}">
                </div>
                <br>
                <div class="form-group col-md-4">
                    <label >Numero de Pagines:</label><br><br>
                    <input type="text" class="form-control " name="npagina" placeholder="305..." value="{{ old('npagina') }}">
                </div>
                <br>
            </div><br><hr><br>
                <div class="row">
                <div class="form-group col-md-4">
                    <label >Edició:</label><br><br>
                    <input type="text" class="form-control " name="edicion" placeholder="Primera edició..." value="{{ old('edicion') }}">
                </div>
                <br>
                <div class="form-group col-md-4">
                    <label >Autor:</label><br><br>
                    <input type="text" class="form-control " name="autor" placeholder="J.K..." value="{{ old('autor') }}">
                </div>
                <br>
                <div class="form-group col-md-4">
                    <label >Preu:</label><br><br>
                    <input type="text" class="form-control " name="precio" placeholder="20€..." value="{{ old('precio') }}">
                </div>
                <br>
            </div><br><br>
            <button type="submit"  class="btn btn-primary">Afegir</button>
        </form>
    </div>


@endsection