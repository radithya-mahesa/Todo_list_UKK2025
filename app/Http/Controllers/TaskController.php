<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::with('subtasks')->get();
        return view('layouts.dashboard', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        Task::create($request->validate([
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:high,medium,normal',
            'completed' => 'boolean|nullable',

        ]));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::with('subtasks')->findOrFail($id);
        return response()->json($task);
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
    // 

    public function update(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);
        $completed = filter_var($request->input('completed', false), FILTER_VALIDATE_BOOLEAN);

        // Validasi untuk input task utama
        $request->validate([
            'name' => 'required|string|max:100',
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
            // default to 0 if not provided
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('layouts.dashboard')->with('success', 'Task berhasil diperbarui');
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
