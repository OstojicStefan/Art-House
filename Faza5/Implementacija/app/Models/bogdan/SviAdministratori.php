<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SviAdministratori extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'administratorr';
    protected $primaryKey = 'IDUser';
}
