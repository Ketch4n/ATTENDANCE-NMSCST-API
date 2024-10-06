<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'schedule';

    protected $fillable = [
        "establishment_id",
        "in_am",
        "out_am",
        "in_pm",
        "out_pm"
    ];
}
