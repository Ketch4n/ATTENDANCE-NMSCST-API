<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaceDataModel extends Model
{
    use HasFactory;

    protected $table = 'face_data';

    protected $fillable = [
        "user_id",
        "user_email",
        "model_data",
        
    ];
}
