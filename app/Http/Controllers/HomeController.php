<?php

namespace App\Http\Controllers;

use App\Events\CreateEntree;
use App\Events\CreateSortieEvent;
use App\Models\Entreé;
use App\Models\History;
use App\Models\Product;
use App\Models\Sortieé;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function GetProductInfo(Request $request)
    {
        $id = $request->product_id;
        $product = Product::find($id);
        return response()->json($product);
    }



    public function EntreeList()
    {
        $entree = Entreé::latest()->paginate(5);
        return view('admin.entreé.index', compact("entree"));
    }
    public function SortieList()
    {
        $entree = Sortieé::latest()->paginate(5);
        return view('admin.sortie.index', compact("entree"));
    }

    public function AddEntree(Request $request)
    {
        $product = Product::find($request->product_id);
        $entree = Entreé::create([
            "product_id" => $request->product_id,
            "prix_achat" => $request->prix_achat,
            "qte" => $request->qte,
            "stock_avant" => $product->stock,
            "observation" => $request->description,
            "user_id" => Auth::user()->id
        ]);
        event(new CreateEntree($entree));

        return redirect()->route('entree.index')->with([
            "success" => "entree added successfly"
        ]);
    }
    public function AddSortie(Request $request)
    {
        $product = Product::find($request->product_id);
        $sortie = Sortieé::create([
            "product_id" => $request->product_id,
            "qte" => $request->qte,
            "stock_avant" => $product->stock,
            "observation" => $request->description,
            "user_id" => Auth::user()->id,
            'prix_ventes' => $request->prix_ventes,
        ]);
        event(new CreateSortieEvent($sortie));
        return redirect()->route('SortieList')->with([
            "success" => "entree added successfly"
        ]);
    }
}
