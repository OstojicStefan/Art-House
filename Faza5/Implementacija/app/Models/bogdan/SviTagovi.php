<?php
// Bogdan Arsic 0329/19
// model za rad sa tagovima
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\SviTagoviFactory;

class SviTagovi extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tag';
    protected $primaryKey = 'IDTag';

    protected $fillable = [
        'Name'
    ];

    protected static function newFactory()
    {
        return SviTagoviFactory::new();
    }
}
