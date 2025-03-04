<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Helpers\TimeHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $task = null;
        $greeting = TimeHelper::getGreeting();
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('layouts.dashboard', compact('greeting', 'tasks'));
    }
}
