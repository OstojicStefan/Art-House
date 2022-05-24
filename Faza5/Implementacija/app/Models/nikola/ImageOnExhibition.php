<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageOnExhibition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'imageonexhibition';

    protected $primaryKey = ['IDExh', 'IDIm'];

    public $incrementing = false;
}
