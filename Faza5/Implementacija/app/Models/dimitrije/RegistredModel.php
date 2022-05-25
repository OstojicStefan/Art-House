<?php

namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistredModel extends Model
{
    use HasFactory;
    public $timestamps = false;

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
