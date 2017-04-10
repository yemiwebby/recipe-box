<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeDirection extends Model
{
    protected $fillable = [

        'description'
    ];

    public $timestamps = FALSE;



    public static  function form()
    {
        return [
          'description' => ''
        ];

    }

}
