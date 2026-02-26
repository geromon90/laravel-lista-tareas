<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Task::query();
        
        if($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if($request->filled('status')) {
            if ($request->status === 'completed') {
                $query->where('completed', true);
            } elseif ($request->status === 'pending') {
                $query->where('completed', false);
            }
        }
        $query->orderBy('created_at', 'desc');
        $tasks = $query->paginate(5);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    //
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente');
    }

    //
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    //
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada');
    }

    public function complete(Task $task)
    {
        $task->update([
            'completed' => true
        ]);
        return redirect()->route('tasks.index')->with('success', 'Tarea completada');
    }
}
