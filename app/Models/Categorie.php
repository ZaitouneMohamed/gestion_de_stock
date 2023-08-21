<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'statue'
    ];
    public function Products()
    {
        return  $this->hasMany(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
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
}
