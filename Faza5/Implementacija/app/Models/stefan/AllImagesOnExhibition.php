<?php

// Autor: Stefan Ostojic, 18/442

namespace App\Models\stefan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllImagesOnExhibition extends Model
{
    use HasFactory;

    protected $table = 'imageonexhibition';
    
    protected $fillable = [
        'Description',
        'OrdinalNumber'
    ];

    public $timestamps = false;
}
