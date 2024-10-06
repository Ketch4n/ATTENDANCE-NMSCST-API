<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentModel extends Model
{
    use HasFactory;

    protected $table = 'absent';

    protected $fillable = [
        "user_id",
        "establishment_id",
        "reason",
        "status",
        
    ];
}
