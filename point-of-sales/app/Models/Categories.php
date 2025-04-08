<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'category_name',
        'is_active',
    ];

    public function activeProducts()
    {
        return $this->hasMany(Products::class, 'category_id')->where('is_active', 1);
    }
}
