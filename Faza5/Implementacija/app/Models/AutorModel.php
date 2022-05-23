<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AutorModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'registred';
    protected $primaryKey = 'IDUser';
    
    protected $fillable = [
        'Username',
        'E-mail',
        'Balance',
        'CardNmber',
        'Password',
        'IsBanned',
        'CCV',
        'FlagHotAuctions',
        'FlagNotifyEnding'
    ];
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
