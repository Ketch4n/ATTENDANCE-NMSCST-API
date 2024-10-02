<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin'; // Specify the custom table name

    protected $fillable = [
        'email',
        'name',
        'role',
        'password',
    ];

    protected $hidden = [
        'password', // Ensure password is hidden when serialized
        'remember_token',
    ];
}

