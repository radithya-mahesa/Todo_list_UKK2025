<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtask;

class SubtaskController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'name' => 'required|string|max:255',
        ]);

        $subtask = Subtask::create([
            'task_id' => $request->task_id,
            'name' => $request->name,
            'is_completed' => false,
        ]);

        // return response()->json($subtask, 201);
        return response()->json(['success' => true, 'subtask' => $subtask]);
    }
    
    public function updateStatus(Subtask $subtask, Request $request)
    {
        $subtask->is_completed = $request->is_completed;
        $subtask->save();

        return response()->json(['success' => true, 'is_completed' => $subtask->is_completed]);
    }

    public function destroy($id)
    {
        $subtask = Subtask::find($id);

        if (!$subtask) {
            return response()->json(['message' => 'Subtask not found'], 404);
        }

        $subtask->delete();
        return response()->json([
            'message' => 'Subtask deleted successfully.',
            'success' => true
        ]);
    }
}
