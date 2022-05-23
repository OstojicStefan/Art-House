<?php

namespace App\Models\bogdan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SviModeratori extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'moderator';
    protected $primaryKey = 'IDUser';
}
