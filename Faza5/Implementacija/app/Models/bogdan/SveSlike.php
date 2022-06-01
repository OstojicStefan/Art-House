<?php
// Bogdan Arsic 0329/19
// model za rad sa slikama
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveSlike extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'image';
    protected $primaryKey = 'IDIm';

    protected $fillable = [
        'Imagee',
        'IDUser',
        'IsPhysical'
    ];

}
