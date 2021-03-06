<?php
//Dimitrije Plavsic 18/220
namespace App\Providers;

use App\Models\dimitrije\RegistredModel;
use Illuminate\Contracts\Auth\UserProvider;
use \Illuminate\Contracts\Auth\Authenticatable;

//provider koji nismo koristili jer smo odlucili da drugacije radimo autentifikaciju korisnika
class RegistredModelProvider implements UserProvider { 

    public function retrieveById($identifier){
        return RegistredModel::where('Username', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token){}

    public function updateRememberToken(Authenticatable $user, $token){}
 
    public function retrieveByCredentials(array $credentials){
        return RegistredModel::where('Username', $credentials['Username'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials){
        return ($user->getAuthPassword() == $credentials['Password']);
    }
}