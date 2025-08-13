<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    public $table = 'brands';

    protected $primary_key = 'id';

    protected $fillable = [
        'name','description','image'
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
}
