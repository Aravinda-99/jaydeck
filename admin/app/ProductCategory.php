<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['name','parent_id','description','category_level'];

    public function parent(){
		return $this->belongsTo(SELF::class, 'parent_id','id');
	}

}
