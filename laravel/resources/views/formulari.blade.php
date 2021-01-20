@extends('layouts.layout')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

@section('contingut')

    Formulari: <a class="float-right" style="color:blue;" href="{{ route('dashboard') }}">Tornar</a>

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
        <form enctype= "multipart/form-data" method="POST" action="{{ route('formulari.dades') }}">
            
            @csrf
            <div class="form-group">
                <label >Email del usuari:</label><br><br>
                <input type="email" class="form-control" name="email" placeholder="exemple@gmail.com..." value="{{ old('email') }}">
            </div>
            <br>
            <div class="form-group">
                <label >NIF:</label><br><br>
                <input type="text" class="form-control" name="nif" placeholder="12345678K..." value="{{ old('nif') }}">
            </div>
            <br>
            <div class="form-group">
                <label >Fitxer:</label><br><br>
                <input type="file" class="form-control" name="fitxer" >
            </div>
            <br>
            <div class="form-group">
                <label >Imatge:</label><br><br>
                <input type="file" class="form-control" name="imatge" >
            </div>
            <br>
            <button type="submit"  class="btn btn-primary">Completar</button>
        </form>
    </div>

@endsection
