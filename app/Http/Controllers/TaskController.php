<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['comment'])->get();
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

    public function update(Request $request)
    {
        $task = Task::query()->find($request->taskId);
        $task->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $task = Task::find($request->taskId);
        $task->first()->delete();
        return to_route('index');
    }
}
