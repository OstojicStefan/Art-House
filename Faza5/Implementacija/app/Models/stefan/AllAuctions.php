<?php

namespace App\Models;

namespace App\Models\stefan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\AllAuctionsFactory;

class AllAuctions extends Model
{
    use HasFactory;

    protected $table = 'auction';
    protected $primaryKey = 'IDAuc';

    protected $fillable = [
        'Name',
        'Description',
        'Author',
        'Year',
        'IDIm',
        'Price',
        'Duration',
        'IsActive',
        'Owner',
        'ViewCount',
        'HighestBidder'
    ];

    public $timestamps = false;

    // Funkcija trazi izlozbu na osnovu ID-ija slike na njoj
    public static function findAuction($imageID)
    {
        return AllAuctions::all()->where('IDIm', $imageID)->first();
    }

    protected static function newFactory()
    {
        return AllAuctionsFactory::new();
    }
}
