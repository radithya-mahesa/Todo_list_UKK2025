<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    // Menampilkan daftar tugas
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('layouts.dashboard', compact('tasks'));
    }

    // TaskController.php
    public function show($id)
    {
        $task = Task::with('subtasks')->findOrFail($id);
        return response()->json($task);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:high,medium,normal',
            'completed' => 'boolean|nullable',
        ]);

        // Tambah user_id ke data yang disimpan
        $validatedData['user_id'] = Auth::id();

        // Simpan ke database
        Task::create($validatedData);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('components.edit-to-do', compact('task'));
    }


    /**
     * Add subtask to specified task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $taskId
     * @return \Illuminate\Http\RedirectResponse
     */

    public function addSubtask(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $subtask = $task->subtasks()->create([
            'name' => $request->name,
            'is_completed' => false,
        ]);

        return response()->json($subtask);
    }

    /**
     * Update the specified resource in storage.
     */
    

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $completed = filter_var($request->input('completed', false), FILTER_VALIDATE_BOOLEAN);

        // Validasi input task utama
        $request->validate([
            'name' => 'required|string|max:30',
            'description' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:high,medium,normal',
            'completed' => 'boolean',
        ]);

        // Update task utama
        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'priority' => $request->input('priority'),
            'completed' => $request->input('completed', 0),
            // default 0
        ]);

        // Redirect 
        return redirect()->route('dashboard')->with('success', 'Task berhasil diperbarui');
    }

    public function getSubtasks($taskId)
    {
        $task = Task::with('subtasks')->find($taskId);
        return view('partials.subtasks-list', compact('task'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Subtask not found'], 404);
        }
        $task->delete();
        return redirect()->back()->with('success', 'Task berhasil dihapus!');
    }
}
