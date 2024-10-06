<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomplishmentModel extends Model
{
    use HasFactory;

    protected $table = 'accomplishment';

    protected $fillable = [
        'user_id',
        'establishment_id',
        'week',
        'report'
    ];
}
