<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
 protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'address',
        'phone',
        'card_number',
        'interventions',
        'chirurgie_generale',
        'weight',
        'tall',
        'bmi',
        'morphologie',
        'peau',
        'graisse',
        'zones',
        'hypertrophie',
        'ptose',
        'asymetrie',
        'tabac',
            'alcool' ,
    'autres_habitudes' ,
    'operations_precedentes',
    'complications',
    ];

    protected $casts = [
        'interventions' => 'array',
    ];
        public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
