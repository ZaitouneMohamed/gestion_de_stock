<?php

namespace App\Listeners;

use App\Events\CreateSortieEvent;
use App\Models\History;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreateSortieListener
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
     * @param  \App\Events\CreateSortieEvent  $event
     * @return void
     */
    public function handle(CreateSortieEvent $event)
    {
        $sortie = $event->sortie;
        $product = $sortie->product;
        $new_qte = $product->stock - $sortie->qte;
        $product->update([
            "stock" => $new_qte
        ]);

        $description = "new sortie by : " . Auth::user()->name . " - sortie " . $sortie->qte . " of " . $product->name;
        $new_sortie = new History(["description" => $description]);
        $product->History()->save($new_sortie);
    }
}
