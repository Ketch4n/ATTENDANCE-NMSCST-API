<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstablishmentModel extends Model
{
    use HasFactory;

    protected $table = 'establishment';

    protected $fillable = [
        'establishment_name',
        'latitude',
        'longitude',
        'location',
        'hours_required',
        'radius',
        'status',
    ];
}
