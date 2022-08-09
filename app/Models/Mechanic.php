<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
}
