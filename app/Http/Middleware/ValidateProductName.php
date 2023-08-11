<?php

namespace App\Http\Middleware;

use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class ValidateProductName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $name = $request->name;
        $categorie = $request->categorie;
        $product = Product::where('name',$name)->where('categorie_id',$categorie)->get();
        if ($product) {
            return redirect()->back()->with([
                "error" => "thisproduct is already exist please try to change the categorie or name"
            ]);
        } else {
            return $next($request);
        }

    }
}
