<?php

namespace App\Http\Controllers\content;

use App\Events\CreateEntree;
use App\Http\Controllers\Controller;
use App\Models\Entreé;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entree = Entreé::paginate(5);
        return view('admin.entreé.index', compact("entree"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        $description = "new entree by : " . Auth::user()->name . " - entree " . $request->qte . " of " . $product->name;
        $new_entree = new History(["description"=> $description]);
        $entree->History()->save($new_entree);

        return redirect()->route('entree.index')->with([
            "success" => "entree added successfly"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
