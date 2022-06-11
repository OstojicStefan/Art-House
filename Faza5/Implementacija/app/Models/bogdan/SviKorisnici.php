<?php
// Bogdan Arsic 0329/19
// model za rad sa korisnicima
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\SviKorisniciFactory;

class SviKorisnici extends Model
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

    protected static function newFactory()
    {
        return SviKorisniciFactory::new();
    }
}
