<?php
//Dimitrije Plavsic 18/220
namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//model za tabelu moderatora
class ModeratorModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'moderator';
    protected $primaryKey = 'IDUser';
}
