<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreé extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'prix_achat',
        'stock_avant',
        'qte',
        'user_id',
        'observation',
    ];
    public function user()
    {
        return  $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function History()
    {
        return $this->morphMany(History::class, "historyable");
    }
}
