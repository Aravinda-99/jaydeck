<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use Datatables;
use Auth;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.main-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        
        $main_category 	= new ProductCategory();
        $main_category->name 	        =   $request->name;
        $main_category->description     =   $request->description;
        $main_category->image           =   $main_image;
        $main_category->user_id         =   Auth::user()->id;
        $main_category->category_level  =   0;
        $main_category->save();

        return response()->json(['msg' => 'Main Category added successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductCategory::findOrFail($id); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->getRules($id));
        $main_image = $this->uploadBase64Image($request->main_image);
      
        $main_category   = ProductCategory::find($request->id);
        $main_category->name            =   $request->name;
        $main_category->description     =   $request->description;
        $main_category->image           =   $main_image;
        $main_category->user_id         =   Auth::user()->id;
        $main_category->save();

        return response()->json(['msg' => 'Main Category updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$checkProduct = Product::where('main_cat_id',$id)->count();
        if($checkProduct == 0){
              $mainDelete = ProductCategory::find($id)->delete();
              $sub = ProductCategory::whereParentId($id)->first();
              if($sub){
              $subDelete = ProductCategory::whereParentId($id)->delete();
              $sub2Delete = ProductCategory::whereParentId($sub->id)->delete();}

        return response()->json(['msg'=>'Category Deleted Successfully!'], 200);

        }else{

            return response()->json([
                'msg' => 'This Category is already used in a product. First you need to delete the product.',
            ], 422);

        }
    }

    public function getAll()
    {
        $main_category = ProductCategory::where('category_level',0)->orderBy('id', 'desc')->get();
        return Datatables::of($main_category)
        ->addIndexColumn()
        ->addColumn('description', function ($row) {
            if($row->description)
            {
                return $row->description;
            }
        })

        ->addColumn( 'Added_date', function ($row) {
            $date = $row->created_at->format('Y-m-d');

            return $date;
        })

        ->addColumn('description', function ($row) {
            if($row->description){
                return $row->description;
            }
            else{
                return '-';
            }
        })

        ->addColumn(
            'action', function ($row) {
                return ' 
                <button type="button" class="btn btn-info" data-id="'.$row->id.'" title="EDIT"><i class="material-icons">edit</i></button>
                <button type="button" class="btn btn-danger" data-id="'.$row->id.'" title="DELETE">
                    <i class="material-icons">delete</i>
                </button>
                ';
            }
        )
        ->editColumn(
            'active', function ($row) {
                $check = $row->active ? 'checked':'';
                return '<div class="switch">
                            <label>
                                <input value="'.$row->id.'" type="checkbox" '.$check.'>
                                <span class="lever switch-col-green"></span>
                            </label>
                        </div>';
            }
        )
        ->rawColumns(['active','action','Added_date','description'])
        ->make(true);
    }

    public function active(Request $request)
    {

        $this->validate($request, ['main_category_id' => 'required|exists:product_categories,id']);
        if($request->active == 1)
        {
            $main_category = ProductCategory::findOrFail($request->main_category_id);
            $main_category->active = 1;
            $main_category->save();

            return response()->json(['msg' => 'Product Category activated successfully'], 200);
        }
        else
        {
            $main_category = ProductCategory::findOrFail($request->main_category_id);
            $main_category->active = 0;
            $main_category->save();

            return response()->json(['msg' => 'Product Category deactivated successfully'], 200);
        }
       
    }

    public function uploadBase64Image($img_data)
    {
      $newname = str_random(10).".png";
      if ($img_data) {
        $data = $img_data;
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $save_target = "../assets/uploads/categories/main_image/".$newname;
        $db_path = "assets/uploads/categories/main_image/".$newname;
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

    /**
     * Overide the $rules varible form the SenseController
     *
     * @param integer $id uses in update to skip rules or alter
     *                    them when updating data
     *
     * @return array
     */
    public function getRules()
    {
        $this->rules = [
            
            'name'       =>  'required|string',
        ];

        return $this->rules;
    }

}
