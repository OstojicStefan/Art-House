<?php

// Autor: Stefan Ostojic, 18/442

namespace App\Models\stefan;

use Database\Factories\AllExibitionsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllExhibitions extends Model
{
    use HasFactory;

    protected $table = 'exhibition';
    protected $primaryKey = 'IDExh';

    protected $fillable = [
        'Name',
        'ImageNumber',
        'Song',
        'FlagDonations',
        'AccumulatedDonations',
        'Date',
        'IsActive',
        'IDUser',
        'Rating',
        'RatingCount'
    ];

    public $timestamps = false;

    protected static function newFactory()
    {
        return AllExibitionsFactory::new();
    }
}
