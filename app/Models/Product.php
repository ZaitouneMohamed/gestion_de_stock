<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'prix',
        'stock_mini',
    ];
    public function user(){
        return  $this->belongsTo(User::class);
    }
    public function categorie(){
        return  $this->belongsTo(Categorie::class);
    }
    public function uniteé(){
        return  $this->belongsTo(Uniteé::class);
    }
}
