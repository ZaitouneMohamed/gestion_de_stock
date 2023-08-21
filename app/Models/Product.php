<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'stock',
        'description',
        'categorie_id',
        'uniteé_id',
        'user_id',
        'statue',
        'prix',
        'stock_mini'
    ];
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function categorie()
    {
        return  $this->belongsTo(Categorie::class);
    }
    public function uniteé()
    {
        return  $this->belongsTo(Uniteé::class);
    }
    public function History()
    {
        return $this->morphMany(History::class, "historyable");
    }
    public function scopeActive($query)
    {
        return $query->where('statue', 1);
    }
    public function scopeInActive($query)
    {
        return $query->where('statue', 0);
    }
    protected static function booted()
    {
        static::updating(function ($product) {
            $changes = $product->getChanges();
            $user = Auth::user(); // Assuming you have authentication set up

            foreach ($changes as $column => $newValue) {
                $oldValue = $product->getOriginal($column);

                History::create([
                    'description' => "Product updated: $column changed from '$oldValue' to '$newValue' by $user->name",
                    'historyable_type' => Product::class,
                    'historyable_id' => $product->id,
                ]);
            }
        });
    }
}
