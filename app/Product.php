<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

	protected $fillable = ['name', 'slug', 'description', 'extract', 'image', 'visible', 'price', 'category_id' , 'type_sale_id'];

    
    // Relation with Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    // Relation with TypeSale
    public function type_sale()
    {
        return $this->belongsTo('App\TypeSale');
    }

    // Relation with OrderItem
    public function order_item()
    {
        return $this->hasOne('App\OrderItem');
    }
}
