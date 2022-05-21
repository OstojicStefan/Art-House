<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveSlike extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'image';
    protected $primaryKey = 'IDIm';

    protected $fillable = [
        'Imagee',
        'IDUser',
        'IsPhysical'
    ];

}
