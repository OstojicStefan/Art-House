<?php

// Autor: Stefan Ostojic, 18/442

namespace App\Models\stefan;

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
        'Rating'
    ];

    public $timestamps = false;
}
