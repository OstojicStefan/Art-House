<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveAukcije extends Model
{
    use HasFactory;
    public $timestamps = false;

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
}
