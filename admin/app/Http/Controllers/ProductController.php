<?php

namespace App\Http\Controllers;

use App\Product;
use App\Brand;
use App\ProductImage;
use App\ProductCategory;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Image;
use File;
use Auth;
use DB;

class ProductController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $activeProdct = Product::where('active' ,'1')->count();

    $inActiveProdct = Product::where('active' ,'0')->count();

    return view('products.index',compact('activeProdct','inActiveProdct'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $mainProductCategory = ProductCategory::where('category_level',0)->get();
    $brands = Brand::all();
    return view('products.create',compact('mainProductCategory','brands'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request, $this->getRules());
    $main_image = $this->uploadBase64Image($request->main_image);

    DB::beginTransaction();

    try {
        $product = new Product();
        $product->name          = $request->name;
        $product->description   = $request->description;
        $product->main_cat_id   = $request->main_cat;
        $product->sub_cat_1_id  = $request->sub_cat_1;
        $product->sub_cat_2_id  = $request->sub_cat_2;
        // $product->brand_id      = $request->brand;
        $product->image         = $main_image;
        $product->active        = 1;
        $product->user_id       = Auth::user()->id;
        $product->save();

        $product_update        = Product::find($product->id);
        $product_update->code  = 'PRO_'.((int)$product->id + 10000);
        $product_update->slug  =  str_slug($request->name).'-'.$product->id;
        $product_update->save();

      if(!empty($request->bulk_image) > 0){
        foreach ($request->bulk_image as $key => $image) {

          $upload_image_path = $this->productImageUpload($product->id,$image);
          if($upload_image_path){

            $product_image = new ProductImage();
            $product_image->product_id = $product->id;
            $product_image->img_src = substr($upload_image_path,3);
            $product_image->save();

          }
        }
      }
      DB::commit();

        // return redirect('product');
      return response()->json(['msg' => 'Product added successfully'], 200);
    } catch (Exception $e) {
      DB::rollback();
      return response()->json(['msg'=>'Something Went wrong!'], 500);
    }
  }

  private function productImageUpload($id,$file){

    $img = Image::make($file);

    $img->fit(698, 398);

    $data = $img->encode();

    $newname = str_random(10) . ".jpg";

    $target = "../assets/uploads/products/product " . $id . "/images";

    $imagePath = $target.'/'.$newname;

    if (!File::exists($target)) {
      File::makeDirectory($target, $mode = 0777, true, true);
    }

    if (file_put_contents($imagePath, $data)) {
      return $imagePath;

    } else {
      return false;
    }

  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Product  $products
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Product  $products
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $products = Product::with('mainProductCategory','subcategory1','subcategory2','brand')->whereId($id)->first();
        // dd($products);
    $product_data = Product::with('images')->findOrFail($id);

    $brands = Brand::all();

    $mainProductCategory = ProductCategory::whereCategoryLevel(0)->get();

    $productid = $id;
    return view('products.edit',compact('productid','mainProductCategory','products','product_data','brands'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Product  $products
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request,$id)
  {
    // dd($request);
    $this->validate($request, $this->getRules2($id));
    $main_image = $this->uploadBase64Image($request->main_image);

    DB::beginTransaction();

    try {
      $product                = Product::find($request->id);
      $product->name          = $request->name;
      $product->description   = $request->description;
      $product->main_cat_id   = $request->main_cat;
      $product->sub_cat_1_id  = $request->sub_cat_1;
      $product->sub_cat_2_id  = $request->sub_cat_2;
      // $product->brand_id      = $request->brand;
      $product->active        = 1;
      $product->user_id       = Auth::user()->id;

      if ($request->main_image) {
        $product->image       = $main_image;
    }
    $product->save();

        //removing old images
    if($request->old_bulk_image_id && count($request->old_bulk_image_id) > 0){
        $removing_images = ProductImage::where('product_id',$request->id)->whereNotIn('id', $request->old_bulk_image_id)->get();
        // foreach ($removing_images as $key => $image) {
          File::delete($removing_images);
        // }
        ProductImage::where('product_id',$request->id)->whereNotIn('id', $request->old_bulk_image_id)->delete();
    }else{
        $removing_images = ProductImage::where('product_id',$request->id);
        // foreach ($removing_images as $key => $image) {
          File::delete($removing_images);
        // }
        ProductImage::where('product_id',$request->id)->delete();
    }

    if(!empty($request->bulk_image)){
        foreach ($request->bulk_image as $key => $image) {

          $upload_image_path = $this->productImageUpload($product->id,$image);
          if($upload_image_path){

            $product_image = new ProductImage();
            $product_image->product_id = $product->id;
            $product_image->img_src = substr($upload_image_path,3);
            $product_image->save();

          }
        }
      }
      DB::commit();

        // return redirect('product');
      return response()->json(['msg' => 'Product updated successfully'], 200);
    } catch (Exception $e) {
      DB::rollback();
      return response()->json(['msg'=>'Something Went wrong!'], 500);
    }
  }

     /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Product  $products
    * @return \Illuminate\Http\Response
    */
     public function destroy($id)
     {
      $product = Product::find($id)->delete();

      $pro_image = ProductImage::whereProductId($id)->delete();

      return response()->json(['msg'=>'Product Deleted Successfully!'], 200);
    }

    public function data(Request $request)
    {
      $products = Product::with('mainProductCategory','subcategory1','subcategory2')->orderBy('id', 'DESC')
        // ->limit(100)
      ->where(function ($q) use ($request){
        if($request->start_date){
          $q->whereDate('created_at','>=',$request->start_date);
        }
        if($request->end_date){
          $q->whereDate('created_at','<=',$request->end_date);
        }
        if($request->status == "active"){
          $q->where('active','1');
        }elseif($request->status == "inactive"){
          $q->where('active','0');
        }
      })
      ->get();

      return Datatables::of($products)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $button = "";

        $button = '<a href="products/'.$row->id.'/edit" type="button" class="btn btn-primary" data-id="'.$row->id.'" title="EDIT"><i class="material-icons">edit</i>
            </a>
            <button type="button" class="btn btn-danger" data-id="'.$row->id.'" title="DELETE">
            <i class="material-icons">delete</i>
            </button>'; 

        return $button;
      })
      
	->addColumn('main_cat', function ($row) {
        if($row->main_cat_id)
        {
          return $row->mainProductCategory->name;
        }
        else
        {
          return '-';
        }
      })
     

      ->addColumn('sub_cat_1', function ($row) {
        if($row->sub_cat_1_id)
        {
          return $row->subcategory1->name;
        }
        else
        {
          return '-';
        }
      })

      ->addColumn('sub_cat_2', function ($row) {
        if($row->sub_cat_2_id)
        {
          return $row->subcategory2->name;
        }
        else
        {
          return '-';
        }
      })

      // ->addColumn('brand', function ($row) {
      //   if($row->brand_id)
      //   {
      //     return $row->brand->name;
      //   }
      // })

      ->editColumn('active', function ($row) {
        $check = $row->active ? 'checked':'';
        return '<div class="switch">
        <label>
        <input value="'.$row->id.'" type="checkbox" '.$check.'>
        <span class="lever switch-col-light-blue"></span>
        </label>
        </div>';
      })

      ->editColumn('pro_image', function ($row) {
          // $pro_image = $row->productImage($row->id);
          // if($pro_image){
        return '<img class="" width="100px" src="../'.$row->image.'">';
        // }
      })

      ->rawColumns(['main_cat','sub_cat_2','sub_cat_1','active','action','pro_image'])
      ->make(true);
    }

    public function active(Request $request){

      $this->validate($request, ['product_id' => 'required|exists:products,id']);
      if($request->status == 1)
      {
        $location = Product::findOrFail($request->product_id);
        $location->active = 1;
        $location->save();

        return response()->json(['msg' => 'Product activated successfully'], 200);
      }
      else
      {
        $location = Product::findOrFail($request->product_id);
        $location->active = 0;
        $location->save();

        return response()->json(['msg' => 'Product deactivated successfully'], 200);
      }
    }

    public function getRules($id=0)
    {

      $this->rules = [
        'img'           => 'nullable',
        "bulk_image"    => "array|max:3",
        'name'          => 'required|max:100',
        // 'brand'         => 'required|max:100',
        // 'description'   => 'required',
        'main_cat'      => 'required|exists:product_categories,id',
        'main_image'    => 'required',
        "images.*"      => "nullable|mimes:jpg,jpeg,gif,png",
      ];


      return $this->rules;
    }

    public function getRules2($id=0)
    {

      $this->rules = [
        'img'           => 'nullable',
        "bulk_image"    => "array|max:3",
        'name'          => 'required|max:100',
        // 'brand'         => 'required|max:100',
        // 'description'   => 'required',
        'main_cat'      => 'required|exists:product_categories,id',
        "images.*"      => "nullable|mimes:jpg,jpeg,gif,png",
      ];


      return $this->rules;
    }

    public function uploadBase64Image($img_data)
    {
      $newname = str_random(10).".png";
      if ($img_data) {
        $data = $img_data;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $save_target = "../assets/uploads/products/main_image/".$newname;
        $db_path = "assets/uploads/products/main_image/".$newname;
        $target = $save_target;


        if (file_put_contents($target, $data)) {
          $img = imagecreatefrompng($target);
          imagealphablending($img, false);

          imagesavealpha($img, true);

          imagepng($img, $target, 8);
          return $db_path;
        } else {
          return "error";
        }
      }
    }

    public function getSubCategoryByMainCategory(Request $request)
    {
      return ProductCategory::whereParentId($request->main_cat)->where('category_level',1)->get();
    }

    public function getSubCategory2BySubCategory(Request $request)
    {
        return ProductCategory::whereParentId($request->sub_cat_1)->where('category_level',2)->get();
    }

  }
