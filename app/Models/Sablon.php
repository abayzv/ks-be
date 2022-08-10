<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sablon extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaction()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
