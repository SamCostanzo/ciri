<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks'));
    }

    // Validate and store a task
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'completed' => false, // Default value
        ]);

        return redirect('/')->with('success', 'Task added!');
    }

    // Mark tasks as complete 
    public function complete(Task $task)
    {
        $task->update(['completed' => true]); // Mark task as completed
        return redirect('/')->with('success', 'Task completed!');
    }

    // Mark tasks as incomplete 
    public function incomplete(Task $task)
    {
        $task->update(['completed' => false]); // Mark task as incomplete
        return redirect('/')->with('success', 'Task reactivated');
    }

    // Delete task
    public function delete(Task $task)
    {
        $task->delete(); // Remove from database
        return redirect('/')->with('success', 'Task deleted!');    
    }

    // Clear Tasks
    public function clearTasks()
    {
        Task::where('completed', false)->delete();
        return redirect()->back()->with('success', 'Tasks cleared!');
    }

    // Clear Completed
    public function clearCompleted()
    {
        Task::where('completed', true)->delete();
        return redirect()->back()->with('success', 'Completed tasks cleared!');
    }

}
