<?php
//Dimitrije Plavsic 18/220
namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model za tabelu administratora
class AdministratorModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'administratorr';
    protected $primaryKey = 'IDUser';
}
