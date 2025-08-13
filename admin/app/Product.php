<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public $table = 'products';

    protected $primary_key = 'id';

    protected $fillable = [
        'name','code','slug','description','image','main_cat_id','sub_cat_1_id','sub_cat_2_id','brand_id'
    ];

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

    public function mainProductCategory(){

        return $this->belongsTo('App\ProductCategory', 'main_cat_id', 'id');
    }

    public function subcategory1(){

        return $this->belongsTo('App\ProductCategory', 'sub_cat_1_id', 'id');
    }

    public function subcategory2(){

        return $this->belongsTo('App\ProductCategory', 'sub_cat_2_id', 'id');
    }
    
    // public function productImage(){

    //     // return $this->hasMany(ProductImage::class,'id','product_id');

    //     return $this->belongsTo('App\ProductImage', 'id', 'product_id');
    // }

    public function productImage($pro_image_id){
        $pro_image =  ProductImage::where(['product_id'=>$pro_image_id,'image_type'=>'main'])->first();
        return $pro_image;
    }

    public function images(){
        return $this->hasMany('App\ProductImage','product_id','id');
    }

    public function brand(){

        return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }
}
