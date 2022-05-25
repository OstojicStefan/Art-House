<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalAuction extends Model
{
    use HasFactory;
    protected $table = 'Physical';
    protected $primaryKey = 'IDAuc';
}
