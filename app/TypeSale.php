<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSale extends Model
{
    protected $table = 'type_sale';

    protected $fillable = ['name'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
