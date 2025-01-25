<?php

namespace App\Http\Controllers;

use App\Helpers\TimeHelper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $greeting = TimeHelper::getGreeting();
        return view('dashboard', compact('greeting'));
    }
}
