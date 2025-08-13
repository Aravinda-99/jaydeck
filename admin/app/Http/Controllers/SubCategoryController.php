<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use Datatables;
use Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = ProductCategory::where('category_level',0)->get();
    	$sub_categories	 = ProductCategory::where('category_level',1)->get();
        return view('categories.sub-categories1.index',compact('main_categories','sub_categories'));
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
        
        $sub_categories1 	= new ProductCategory();
        $sub_categories1->name 	            =   $request->name;
        $sub_categories1->description       =   $request->description;
        $sub_categories1->parent_id         =   $request->parent;
        $sub_categories1->user_id           =   Auth::user()->id;
        $sub_categories1->category_level    =   1;
        $sub_categories1->save();

        return response()->json(['msg' => 'Sub Category added successfully'], 200);
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
      
        $sub_categories1               =   ProductCategory::find($request->id);
        $sub_categories1->name         =   $request->name;
        $sub_categories1->description  =   $request->description;
        $sub_categories1->parent_id    =   $request->parent;
        $sub_categories1->user_id      =   Auth::user()->id;
        $sub_categories1->save();

        return response()->json(['msg' => 'Sub Category updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkProduct = Product::where('sub_cat_1_id',$id)->count();
        if($checkProduct == 0){

            $sub = ProductCategory::find($id)->delete();
            $sub2 = ProductCategory::whereParentId($id)->first();
            if($sub2){
            	$sub2Delete = ProductCategory::whereParentId($id)->delete();
            }

            return response()->json(['msg' => 'Sub Category deleted successfully'], 200);

        }else{

            return response()->json([
                'msg' => 'This Category is already used in a product. First you need to delete the product.',
            ], 422);

        } 
    }

    public function getAll()
    {
        $sub_categories1 = ProductCategory::where('category_level',1)->orderBy('id', 'desc')->get();
        return Datatables::of($sub_categories1)
        ->addIndexColumn()

        ->addColumn('parent', function ($row) {


            return ($row->parent)? $row->parent->name : '';
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
                <button type="button" class="btn btn-info" data-id="'.$row->id.'"><i class="material-icons" title="EDIT">edit</i></button>
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
        ->rawColumns(['active','action','parent'])
        ->make(true);
    }

    public function active(Request $request){

        $this->validate($request, ['sub_category1_id' => 'required|exists:product_categories,id']);
        if($request->active == 1)
        {
            $sub_categories1 = ProductCategory::findOrFail($request->sub_category1_id);
            $sub_categories1->active = 1;
            $sub_categories1->save();

            return response()->json(['msg' => 'Sub Category activated successfully'], 200);
        }
        else
        {
            $sub_categories1 = ProductCategory::findOrFail($request->sub_category1_id);
            $sub_categories1->active = 0;
            $sub_categories1->save();

            return response()->json(['msg' => 'Sub Category deactivated successfully'], 200);
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
            'name'       => 'required|string',
            'description'=> 'nullable|max:100',
            'parent'	 => 'required',
        ];

        return $this->rules;
    }
}
