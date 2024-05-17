<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class akun extends Authenticatable implements AuthenticatableContract
{
    use Notifiable;
    use HasFactory;
    protected $table = 'akun';
    protected $primaryKey = 'idakun';
}
