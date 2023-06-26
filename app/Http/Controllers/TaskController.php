<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('welcome', compact('tasks'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => "required",
            'body' => "required",
        ]);
        $task = Task::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('index');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => 1
        ]);

        return $task;
    }

    public function delete(Request $request)
    {
        $id = Task::find($request->taskId)->get();
        $id->first()->delete();
        return to_route('index');
    }
}
