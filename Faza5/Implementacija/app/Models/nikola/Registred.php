<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registred extends Model
{
    use HasFactory;

    protected $table = 'Registred';
    protected $primaryKey = 'IDUser';
    public $timestamps = false;

    protected $fillable = [
        'Balance'
    ];
    public static function updateBalance($iduser, $amount)
    {
        $user = Registred::find($iduser);
        $user->Balance = $user->Balance + $amount;
        $user->save();
    }
}
