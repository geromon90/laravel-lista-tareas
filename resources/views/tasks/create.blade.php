@extends('layouts.app')
@section('content')

<h1>Crear tarea</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/tasks" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Titulo">
    <textarea name="description"></textarea>
    <button>Guardar</button>
</form>

@endsection