<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
      'name', 'description', 'image'
    ];

    /**Establish relationship with user's table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Establish relationship with ingredients table
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    /**
     * Relationship with ingredient direction
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directions()
    {
        return $this->hasMany(RecipeDirection::class);
    }

    /**
     * A function that can be accessed anywhere
     */
    public static function form()
    {
        return [
            'name'               => '',
            'description'        => '',
            'image'              => '',
            'ingredients'        => [
              RecipeIngredient::form()
            ],

            'directions'        =>  [
                RecipeDirection::form(),
                RecipeDirection::form()
            ]
        ];
    }
}
