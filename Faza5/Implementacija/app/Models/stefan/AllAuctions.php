<?php

namespace App\Models;

namespace App\Models\stefan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'IDTag',
        'Price',
        'Duration',
        'IsActive',
        'Owner',
        'ViewCount',
        'HighestBidder'
    ];

    public $timestamps = false;

    public static function findAuction($imageID)
    {
        return AllAuctions::all()->where('IDIm', $imageID)->first();
    }
}
