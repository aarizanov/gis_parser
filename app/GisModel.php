<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GisModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gis_models';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
