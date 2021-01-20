@extends('layouts.layout')

@section('content')

    Crear nou usuari: <a class="float-right" style="color:blue;" href="{{url('/prova')}}">Tornar</a>

@endsection

@section('content_2')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>Corrige los siguientes errores:</p>
            <br>
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-6 bg-white border-b border-gray-200"> 
        <form action="" method="POST" action="{{ url('/nou_usuari/nou') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nom</label>
                <input type="text" class="form-control" name="name" placeholder="Angelito...">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputEmail1">Correu Electronic</label>
                <input type="email" class="form-control" name="email" placeholder="Exemple@gmail.com...">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1">Constrasenya</label>
                <input type="password" class="form-control" name="password" placeholder="123456...">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleInputPassword1">Confirma Constrasenya</label>
                <input type="password" class="form-control" name=" password_confirm" placeholder="123456...">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

@endsection
