<?php

namespace App\Listeners;

use App\Events\CreateEntree;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreateEntreeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateEntree  $event
     * @return void
     */
    public function handle(CreateEntree $event)
    {
        $entree = $event->entree;
        $product = $entree->product;
        $new_qte = $product->stock + $entree->qte;
        $product->update([
            "stock" => $new_qte
        ]);
        $description = "new sortie by : " . Auth::user()->name . " - sortie " . $entree->qte . " of " . $product->name;
        $new_history = new History(["description" => $description]);
        $product->History()->save($new_history);
    }
}
