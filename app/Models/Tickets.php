<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
//    use CrudTrait;
    use HasFactory;

    public $fillable = [
        'title',
        'price',
        'min',
        'max',
        'students',
        'event_id'
    ];

}
