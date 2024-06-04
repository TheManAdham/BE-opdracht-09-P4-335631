<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'housenumber',
        'zipcode',
        'city',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
