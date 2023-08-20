<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HistoryList()
    {
        $history = History::latest()->get();
        return view('admin.history', compact("history"));
    }

    function GetProductOfCategorie(Request $request)
    {
        $id = $request->categorie_id;
        $products = Product::where('categorie_id', $id)->get();
        return response()->json($products);
    }
}
