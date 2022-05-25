<?php

namespace App\Providers;

use App\Models\AutorModel;
use Illuminate\Contracts\Auth\UserProvider;
use \Illuminate\Contracts\Auth\Authenticatable;

class AutorModelProvider implements UserProvider{

    public function retrieveById($identifier){
        return AutorModel::where('Username', $identifier)->first();
    }

    public function retrieveByToken($identifier, $token){}

    public function updateRememberToken(Authenticatable $user, $token){}

 
    public function retrieveByCredentials(array $credentials){
        return AutorModel::where('Username', $credentials['username'])->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials){
        return $user->getAuthPassword() == $credentials['password'];
    }
}