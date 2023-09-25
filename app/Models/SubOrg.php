<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubOrg extends Model
{
    use HasFactory;
    protected $table = 'orgs_sub';
    public $timestamps = false;
}
