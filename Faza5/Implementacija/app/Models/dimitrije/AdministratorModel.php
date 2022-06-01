<?php

namespace App\Models\dimitrije;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorModel extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'administratorr';
    protected $primaryKey = 'IDUser';
}
