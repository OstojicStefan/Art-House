<?php

namespace App\Models\nikola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualAuction extends Model
{
    use HasFactory;
    protected $table = 'Virtuall';
    protected $primaryKey = 'IDAuc';
}
