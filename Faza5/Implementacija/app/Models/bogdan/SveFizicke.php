<?php
// Bogdan Arsic 0329/19
// model za rad sa aukcijama fizickih slika
namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveFizicke extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'physical';
    protected $primaryKey = 'IDAuc';

    protected $fillable = [
        'Location'
    ];
}
