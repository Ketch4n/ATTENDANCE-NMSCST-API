<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTRModel extends Model
{
    use HasFactory;

    protected $table = 'dtr';

    protected $fillable = [
        "user_id",
        "establishment_id",
        "in_am",
        "out_am",
        "in_pm",
        "out_pm"
        
    ];
}
