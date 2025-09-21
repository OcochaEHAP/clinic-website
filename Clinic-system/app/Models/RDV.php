<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RDV extends Model

{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'date',
        'time',
        'service',
        'message',
        'status',
        'type',
    ];
}
