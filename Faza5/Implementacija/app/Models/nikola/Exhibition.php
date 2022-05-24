<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $table = 'exhibition';
    protected $primaryKey = 'idexh';

    public static function findExhibitions($request)
    {
        $exhibitions = "";
        $organizers = Registred::where('Username', 'like', "%$request->organizer%")->get('IDUser');
        //all
        if ($request->type == 'All') {
            $exhibitions = Exhibition::where('Name', 'Like', "%$request->name%")->where('IDUser', 'in', "$organizers")->get();
        }
        //active
        else if ($request->type == 'Active') {
            $exhibitions = Exhibition::where('Name', 'Like', "%$request->name%")->where('IDUser', 'in', "$organizers")->where('IsActive', '=', 't')->get();
        }
        //expired
        else if ($request->type == 'Expired') {
            $exhibitions = Exhibition::where('Name', 'Like', "%$request->name%")->where('IDUser', 'in', "$organizers")->where('IsActive', '=', 'f')->get();
        }
        return $exhibitions;
    }
}
