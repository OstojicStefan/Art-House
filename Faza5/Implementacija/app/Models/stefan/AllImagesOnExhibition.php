<?php

// Autor: Stefan Ostojic, 18/442

namespace App\Models\stefan;

use Database\Factories\AllImagesOnExibitionFactory;
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

    //Ova funkcija vraca prvu sliku na koju naidje na zadatoj izlozbi
    public function findImageOnExhibition($idExh)
    {
        return AllImagesOnExhibition::all()->where('IDExh', $idExh)->first();
    }

    protected static function newFactory()
    {
        return AllImagesOnExibitionFactory::new();
    }
}
