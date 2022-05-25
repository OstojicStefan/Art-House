<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SviTagoviWithImage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'imagewithtags';
    protected $primaryKey = ['IDIm', 'IDTag'];
    public $incrementing = false;

    protected $fillable = [
        'IDIm',
        'IDTag'
    ];
}
