<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $main_categories = ProductCategory::whereCategoryLevel(0)->get();
        $proCount = $products->count();
        $mainCatCount = $main_categories->count();

        return view('dashboard',compact('proCount','mainCatCount'));
    }

}
