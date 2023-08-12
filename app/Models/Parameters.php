<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'footer',
    ];
    public function History()
    {
        return $this->morphMany(History::class, "historyable");
    }
}
