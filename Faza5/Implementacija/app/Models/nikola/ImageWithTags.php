<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageWithTags extends Model
{
    use HasFactory;
    // protected $primaryKey = 'idim'; //nije tacno ali nije ni korisceno
    public $timestamps = false;
    protected $table = 'imagewithtags';

    protected $primaryKey = ['IDIm', 'IDTag'];

    public $incrementing = false;



    protected $fillable = [

        'IDIm',

        'IDTag'

    ];
}
