@extends('layouts.app')
@section('content')

@if(session('success'))
    <div style="color:green;">
        {{ session('success') }}
    </div>
@endif

<h1>Lista de tareas</h1>

<a href="/tasks/create">Nueva tarea</a>

<form method="GET" action="{{ route('tasks.index') }}">
    <input type="text" name="search" placeholder="Buscar tarea..." value="{{ request('search') }}">
    <select name="status">
        <option value="">-- Todas --</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completadas</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendientes</option>
    </select>
    <button type="submit">Buscar</button>
</form>

@foreach($tasks as $task)
    <p>
        @if($task->completed)
            <span style="text-decoration: line-through;">
                {{ $task->title }}
            </span>
        @else
            {{ $task->title }}
        @endif

        <a href="{{ route('tasks.edit', $task) }}">Editar</a>

        @if(!$task->completed)
            <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                @csrf
                @method('PATCH')
                <button>Completar</button>
            </form>
        @endif

        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button>Eliminar</button>
        </form>
    </p>
@endforeach

{{ $tasks->appends(request()->query())->links() }}

@endsection