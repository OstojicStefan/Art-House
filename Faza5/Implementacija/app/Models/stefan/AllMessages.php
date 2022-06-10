<?php

namespace App\Models\stefan;

use App\Models\bogdan\SviKorisnici;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllMessages extends Model
{
    use HasFactory;

    protected $table = 'message';
    protected $primaryKey = 'IDMes';

    protected $fillable = [
        'IDUser',
        'IDExh',
        'Text',
    ];

    public $timestamps = false;

    // Funkcija koja trazi username korisnika sa prosledjenim ID-ijem
    public function findUsername($userID)
    {
        $users = new SviKorisnici();
        $user = $users->where('IDUser', $userID)->get();
        return $user[0]->Username;
    }
}
