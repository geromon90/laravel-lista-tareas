@extends('layouts.app')
@section('content')

<h1>Editar tarea</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $task->title }}">
    <textarea name="description">{{ $task->description }}</textarea>
    <button>Actualizar</button>
</form>

@endsection