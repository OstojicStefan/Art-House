<?php

namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RegistredModel extends Authenticatable
{
    use HasFactory, Notifiable;
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
    public function getAuthPassword()
    {
        return $this->Password;
    }
}
