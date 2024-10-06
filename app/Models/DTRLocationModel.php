<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTRLocationModel extends Model
{
    use HasFactory;

    protected $table = 'dtr_location';

    protected $fillable = [
        "dtr_id",

        "in_am_latitude",
        "in_am_longitude",

        "out_am_latitude",
        "out_am_longitude",

        "in_pm_latitude",
        "in_pm_longitude",

        "out_pm_latitude",
        "out_pm_longitude",
    
    ];
}
