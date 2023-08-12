<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HistoryList()
    {
        $history = History::latest()->get();
        return view('admin.history',compact("history"));
    }
}
