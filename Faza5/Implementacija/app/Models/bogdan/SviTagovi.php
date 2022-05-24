<?php
// Bogdan Arsic 0329/19
// model za rad sa tagovima
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\Promise\all;

class SviTagovi extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'tag';
    protected $primaryKey = 'IDTag';

    protected $fillable = [
        'Name'
    ];
}
