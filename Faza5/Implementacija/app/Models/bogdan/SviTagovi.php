<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function GuzzleHttp\Promise\all;

class SviTagovi extends Model
{
    use HasFactory;

    protected $table = 'tag';
    protected $primaryKey = 'IDTag';

    protected $fillable = [
        'Name'
    ];
}
