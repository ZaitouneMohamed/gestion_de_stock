<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniteé extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'statue'
    ];
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
