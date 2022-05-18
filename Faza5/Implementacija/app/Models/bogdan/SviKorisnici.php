<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SviKorisnici extends Model
{
    use HasFactory;

    protected $table = 'registred';
    protected $primaryKey = 'IDUser';

    protected $fillable = [
        'Username',
        'E_mail',
        'Balance',
        'CardNmber',
        'Password',
        'IsBanned',
        'CCV',
        'FlagHotAuctions',
        'FlagNotifyEnding'
    ];
}
