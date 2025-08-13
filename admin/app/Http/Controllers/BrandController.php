<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use Validator;
use Datatables;
use Image;
use File;
use Auth;
use DB;

class BrandController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $activeBrand = Brand::where('active' ,'1')->count();

    $inActiveBrand = Brand::where('active' ,'0')->count();

    return view('brands.index',compact('activeBrand','inActiveBrand'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('brands.create');
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
        $brand = new Brand();
        $brand->slug          = str_slug($request->name);
        $brand->name          = $request->name;
        $brand->description   = $request->description;
        $brand->image         = $main_image;
        $brand->active        = 1;
        $brand->user_id       = Auth::user()->id;
        $brand->save();

        DB::commit();

        // return redirect('brand');
        return response()->json(['msg' => 'Brand added successfully'], 200);
    } catch (Exception $e) {
      DB::rollback();
      return response()->json(['msg'=>'Something Went wrong!'], 500);
  }
}

  /**
  * Display the specified resource.
  *
  * @param  \App\Brand  $brands
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Brand  $brands
  * @return \Illuminate\Http\Response
  */
    public function edit($id)
    {
        $brands = Brand::whereId($id)->first();

        $brandid = $id;
        return view('brands.edit',compact('brandid','brands'));
    }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Brand  $brands
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request,$id)
  {
    // dd($request);
    $this->validate($request, $this->getRules2($id));
    $main_image = $this->uploadBase64Image($request->main_image);

    DB::beginTransaction();

    try {
        $brand                = Brand::find($request->id);
        $brand->name          = $request->name;
        $brand->description   = $request->description;
        $brand->active        = 1;
        $brand->user_id       = Auth::user()->id;

        if ($request->main_image) {
          $brand->image       = $main_image;
        }
        $brand->save();

        DB::commit();

        // return redirect('brand');
        return response()->json(['msg' => 'Brand updated successfully'], 200);
    } catch (Exception $e) {
        DB::rollback();
        return response()->json(['msg'=>'Something Went wrong!'], 500);
        }
    }

     /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Brand  $brands
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $brand = Brand::find($id)->delete();

        return response()->json(['msg'=>'Brand Deleted Successfully!'], 200);
    }

    public function data(Request $request)
    {
        $brands = Brand::orderBy('id', 'DESC')
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

        return Datatables::of($brands)
        ->addIndexColumn()
        
        ->addColumn('action', function ($row) {
          return '
          <button type="button" class="btn btn-success" data-id="'.$row->id.'" data-toggle="modal" data-target="#viewBrandModal" onclick="viewBrandModal('.$row->id.')" title="VIEW"><i class="material-icons">visibility</i>
          </button> &nbsp;
          <a href="brands/'.$row->id.'/edit" type="button" class="btn btn-primary" data-id="'.$row->id.'" title="EDIT"><i class="material-icons">edit</i>
          </a>
          <button type="button" class="btn btn-danger" data-id="'.$row->id.'" title="DELETE">
                    <i class="material-icons">delete</i>
                </button>';
        })

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
          // $pro_image = $row->brandImage($row->id);
          // if($pro_image){
            return '<img class="" width="100px" src="../'.$row->image.'">';
        // }
    })

        ->rawColumns(['active','action','pro_image'])
        ->make(true);
    }

    public function active(Request $request){

        $this->validate($request, ['brand_id' => 'required']);

        $brand = Brand::findOrFail($request->brand_id);
        $brand->active = $request->status;
        $brand->save();

        return response()->json(['msg' => 'Brand status changed successfully'], 200);
    }

    public function getRules($id=0)
    {

        $this->rules = [
            'name'          => 'required|max:100',
            'main_image'    => 'required',
        ];


      return $this->rules;
    }

    public function getRules2($id=0)
    {

        $this->rules = [
            'name'          => 'required|max:100',
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

          $save_target = "../assets/uploads/brands/main_image/".$newname;
          $db_path = "assets/uploads/brands/main_image/".$newname;
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

    public function viewBrand(Request $request)
    {
        $brand = Brand::whereId($request->id)->first();
        return view('brands.view',compact('brand'));
    }

}
