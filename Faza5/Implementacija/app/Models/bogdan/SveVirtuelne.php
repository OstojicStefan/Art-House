<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SveVirtuelne extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'virtuall';
    protected $primaryKey = 'IDAuc';

}
