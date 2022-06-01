<?php
// Bogdan Arsic 0329/19
// model za rad sa izlozbama
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveIzlozbe extends Model
{
    use HasFactory;
    public $timestamps = false;

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
}
