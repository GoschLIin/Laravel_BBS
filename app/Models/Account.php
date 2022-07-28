<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Account as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'accounts';

    protected $fillable = [
        'name', 
        'login_id', 
        'password'
    ];
}