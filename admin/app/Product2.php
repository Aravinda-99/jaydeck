<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function generateSlug()
    {
        // Replaces all spaces with hyphens.
        $string = str_replace(' ', '-', $this->name . ' ' . $this->id); 
        // Replaces multiple hyphens with single one.
        $string = preg_replace('/-+/', '-', $string); 
        // Make lowercase
        $string = strtolower($string); 
        // Remove special characters
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

    public function images(){
        return $this->hasMany('App\ProductImage','product_id','id');
    }

    public function mainProductCategory(){

        return $this->belongsTo('App\ProductCategory', 'main_cat_id', 'id');
    }

    public function subcategory(){

        return $this->belongsTo('App\ProductCategory', 'sub_cat_id', 'id');
    }

    public function brand(){

        return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }
}
