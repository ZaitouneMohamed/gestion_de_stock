<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'historyable_id',
        'historyable_type',
    ];
    public function historyable()
    {
        return $this->morphTo();
    }
}
