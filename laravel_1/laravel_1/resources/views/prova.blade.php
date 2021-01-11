@extends('layouts.layout')

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/f12dd97a4b.js" crossorigin="anonymous"></script>

@section('content')

Llistat de Usuaris:<a class="float-right" style="color:blue;" href="{{url('/nou_usuari')}}">Crear nou Usuari</a>

@endsection

@section('content_2')

@foreach ($users as $user)

  <div class="p-6 bg-white border-b border-gray-200">   
    <ul>
      <li>{{ $user->name }}, {{ $user->email }} <a href="{{ url('/nou_usuari/info',['id' => $user->id] )}}" class="float-right fas fa-info"></a> </li>
  </div>

@endforeach

@endsection
