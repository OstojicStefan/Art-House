<?php

// Autor: Stefan Ostojic, 18/442

namespace App\Models\stefan;

use Database\Factories\AllImagesFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllImages extends Model
{
    use HasFactory;

    protected $table = 'image';
    protected $primaryKey = 'IDIm';

    protected $fillable = [
        'IsPhysical',
    ];

    public $timestamps = false;

    //Ova funkcija vraca sve slike korisnika sa prosledjenim ID-jem
    public function findUsersImages($id)
    {
        return AllImages::all()->where('IDUser',$id);
    }

    //Ova funkcija vraca ID slike tako sto vrsi poredjenje sa svim slikama korisnika gledajuci polje src
    public function findImageID($usersImages, $imageSrc)
    {
        foreach($usersImages as $image){
            if (!strncmp("data:image/jpg;base64,".chunk_split($image->Imagee), $imageSrc, 300)){
                $imageID=$image->IDIm;
            }  
        }
        return $imageID;
    }

    public function findImage($imageID)
    {
        return AllImages::all()->where('IDIm', $imageID)->first();
    }

    protected static function newFactory()
    {
        return AllImagesFactory::new();
    }
}