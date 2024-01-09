<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * https://codereview.stackexchange.com/questions/283008/laravel-eager-loading-tickets-from-db
 */
class Events extends Model
{
//    use CrudTrait;
    use HasFactory;

//    use Sluggable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'start',
        'end',
        'category',
        'level',
        'bookable',
        'additional_info',
        'repeats',
        'duration',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start' => 'datetime',
        'end' => 'datetime',
        'category' => 'string',
        'level' => 'integer',
        'boookable' => 'boolean',
        'repeats' => 'integer',
        'duration' => 'integer',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'event_id');

    }
}
