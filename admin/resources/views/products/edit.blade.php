@extends('layouts.app')
@section('title', 'Products')
@push('moreCss')
  @include('includes.datatables-css')
  @include('includes.form-css')
  <style>
  .row {
      margin-left: 0px !important;
    }
    .imageBox
    {
      position: relative;
      height: 650px;
      width: 650px;
      border:1px solid #aaa;
      background: #fff;
      overflow: hidden;
      background-repeat: no-repeat;
      cursor:move;
    }

    .imageBox .thumbBox
    {
      position: absolute;
      top: 4%;
      left: 4%;
      width: 602px;
      height: 602px;
      box-sizing: border-box;
      border: 1px solid rgb(102, 102, 102);
      box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
      background: none repeat scroll 0% 0% transparent;
    }

    .imageBox .spinner
    {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      text-align: center;
      line-height: 400px;
      background: rgba(0,0,0,0.7);
    }
    .boxGray{
      background-color: #ccc;
      padding-top: 13px;
      padding-left: 10px;
    }

    .action
    {
      width: 400px;
      height: 30px;
      margin: 10px 0;
    }
    .cropped>img
    {
      margin-right: 10px;
    }
    .hidden
    {
      display: none;
    }
    .redstar
    {
      color:red;
    }
    .view-count {
    font-weight: normal;
    font-size: 26px;
    margin-top: -4px;
    color: #fff;
  }

  .modal-content{
    width: fit-content !important;
  }


</style>
<link href="{{asset('assets/css/image-bulk-upload.css')}}" media="all" rel="stylesheet" type="text/css"/>
@endpush
@section('pageTitle', 'Orders')
@section('content')
  <style>
  /*.view-count {
    font-weight: normal;
    font-size: 26px;
    margin-top: -4px;
    color: #fff;
  }

  .modal-content{
    width: fit-content !important;
  }*/
 /* .imageBox
  {
    position: relative;
    height: 400px;
    width: 700px;
    border:1px solid #aaa;
    background: #fff;
    overflow: hidden;
    background-repeat: no-repeat;
    cursor:move;
  }

  .imageBox .thumbBox
  {
    position: absolute;
    top: 25%;
    left: 14%;
    width: 700px;
    height: 400px;
    margin-top: -100px;
    margin-left: -100px;
    box-sizing: border-box;
    border: 1px solid rgb(102, 102, 102);
    box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
    background: none repeat scroll 0% 0% transparent;
  }

  .imageBox .spinner
  {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    text-align: center;
    line-height: 400px;
    background: rgba(0,0,0,0.7);
  }*/

</style>
<section class="content">
  <div class="container-fluid">
      <div class="block-header">
        <h2>PRODUCT MANAGEMENT</h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <span class="pull-right">
                  <a href="{{route('products.index')}}" class="btn btn-primary btn-sm">PRODUCT LIST</a>
                </span>
                    <h2>
                        UPDATE PRODUCTS
                        <small>update products in the system</small>
                    </h2>
                </div>

                <div class="body">
                  <div class="row clearfix">
                    {!! Form::open(['url' => 'products','id' => 'formCreate', 'class' => 'form-horizontal', 'name'=> 'formCreate','method'=>'POST'])!!}
                    {{-- <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              <label for="title">Code</label>
                                <input type="text" class="form-control" name="code" value="{{$products->code}}">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              <label for="title">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$products->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                           <div class="form-line">
                              <label for="title">Description</label>
                                <textarea name="description" class="form-control" rows="2">{{$products->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="margin-bottom:5%">
                      <label for="title">Main Category</label>
                        <select class="form-control show-tick" name="main_cat" id="main_cat" onchange="getSubCategoryByMainCategory()">
                          @foreach ($mainProductCategory as $main_category)
                          @if($products->main_cat_id == $main_category->id)
                            <option value="{{ $main_category->id }}" selected>{{ $main_category->name }}</option>
                          @else
                            <option value="{{ $main_category->id }}">{{ $main_category->name }}</option>
                          @endif
                          @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6" style="margin-bottom:5%">
                      <label for="title">Sub Category 1</label>
                        <select class="form-control show-tick" name="sub_cat_1" id="sub_cat_1" onchange="getSubCategory2BySubCategory()">
                          @if($products->sub_cat_1_id)
                            <option value="{{ $products->sub_cat_1_id }}" selected>{{ $products->subcategory1->name }}</option>
                          @endif
                        </select>
                    </div>
                    <div class="col-sm-6" style="margin-bottom:5%">
                      <label for="title">Sub Category 2</label>
                        <select class="form-control show-tick" name="sub_cat_2" id="sub_cat_2">
                            @if($products->sub_cat_2_id)
                            <option value="{{ $products->sub_cat_2_id }}" selected>{{ $products->subcategory2->name }}</option>
                            @endif
                        </select>
                    </div>
                    {{-- <div class="col-sm-6" style="margin-bottom:5%">
                        <label for="title">Brand</label>
                        <select class="form-control show-tick" name="brand" id="brand">
                          @foreach ($brands as $brand)
                          @if($products->brand_id == $brand->id)
                            <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                          @else
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                          @endif
                          @endforeach
                        </select>
                    </div> --}}
                    <div class="col-xs-12" style="padding-left:0px !important;">
                      <div class="container-fluid">
                        {{-- <span style="color:red">*</span> --}}
                        <label class="control-label">Product Main Image</label>
                        <div class="imageBox">
                          <div class="thumbBox"></div>
                          <div class="spinner" style="display: none">Loading...</div>
                        </div>
                        <div class="action">
                          <input type="file" id="file" style="float:left; width: 250px">
                          <button type="button" id="btnCrop"  style="float: right"><span id="loading"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></span> Crop</button>
                          <input type="button" id="btnZoomIn" value="+" style="float: right">
                          <input type="button" id="btnZoomOut" value="-" style="float: right">
                        </div>

                        <input type="hidden" id="main_image"  name="main_image" form="formCreate"  value="">
                      </div>
                    </div>
                    <div class="cropped col-xs-12">
                        <br><br>
                      <img src="{{url("../".$products->image)}}" style="max-width:100%;">
                    </div>
                    <div class="col-md-12" style="margin-bottom:5%">
                      <div>
                        <label>Other Images (Max: 3 Images)</label>
                        <br>
                        <div id="imagesBundleContent"></div>
                          <div>
                            <div class="input-group mb-3">
                            <div>
                            <input type="file" multiple id="imagesBulkUploadInput" data-max-count="3">
                            <label class="custom-file-label" for="imagesBulkUploadInput">Choose images</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      @foreach($product_data->images as $old_image)
                      <input type="hidden" data-id="{{$old_image->id}}" class="old-bulk-images" value="'{{asset('../'.$old_image->img_src)}}'">

                     {{--  {{url("../airport-parking-advisor/assets/uploads/airports/airport".$airports->id."/images/".$old_image->img_src)}} --}}
                     {{-- {{asset($old_image->img_src)}} --}}
                      @endforeach
                    </div>
                    <div class="col-sm-12" style="margin-bottom:5%">
                       @if (count($errors) > 0)
                      <div >
                        <ul>
                          @foreach ($errors->all() as $error)
                          <li style="color:red">{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                      @endif
                    </div>
                    <div class="col-sm-12">
                    {{--<button type="submit" class="btn btn-default btn-sm form" id="btnSubmit">SUBMIT</button>--}}
                    <button class="btn btn-primary" type="button" name="button" id="btnSubmit">Submit</button>
                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('moreJs')
  @include('includes.form-js')
  @include('includes.datatables-js')
  {{-- <script src="{{ asset('assets/js/product-handler.js') }}" charset="utf-8"></script> --}}
  <script src="{{ asset('assets/js/cropbox.js') }}"></script>
  <script src="{{ asset('assets/js/crud-2.0.js') }}" charset="utf-8"></script>
  <script src="{{asset('assets/js/image-bulk-upload.js')}}"></script>
  {{-- <script src="{{URL::asset('assets/js/admin.js')}}"></script> --}}
  {{-- CRUD SETUP --}}
  <script type="text/javascript">

  var ajaxURL = base_url+"/products/{{$productid}}/update"
  var SSPEnable = false
  var opt = {responsive: true}


  function submitData(url,method)
  {

    formData = new FormData(document.getElementById('formCreate'))
    ajaxCall(formData,method)
  }

  function ajaxCall(data,method) {
    $('#btnSubmit').prop("disabled", "disabled");
    $.ajax({
      url: url,
      type: method,
      dataType: 'JSON',
      data: data,
      processData: false,
      contentType: false,
    })
    .done(function(data) {
      onLoading([],0)
      onSuccess(data.msg)

      window.location.replace("{{ url('products') }}")

    })
    .fail(function(data) {
      onLoading([],0)
      errorHandler(data.responseJSON)
    })

  }

</script>
<script type="text/javascript">
window.onload = function() {
  var options =
  {
    imageBox: '.imageBox',
    thumbBox: '.thumbBox',
    spinner: '.spinner',

  }
  var cropper = new cropbox(options);
  document.querySelector('#file').addEventListener('change', function(){
    var reader = new FileReader();
    reader.onload = function(e) {
      options.imgSrc = e.target.result;
      cropper = new cropbox(options);
    }
    reader.readAsDataURL(this.files[0]);
    this.files = [];
  })
  document.querySelector('#btnCrop').addEventListener('click', function(){
    var img = cropper.getDataURL()
    document.querySelector('.cropped').innerHTML = '<img id="crop" style="max-width : 100%;" src="'+img+'">';
    $('#main_image').val(img);
  })
  document.querySelector('#btnZoomIn').addEventListener('click', function(){
    cropper.zoomIn();
  })
  document.querySelector('#btnZoomOut').addEventListener('click', function(){
    cropper.zoomOut();
  })


};
</script>
<script type="text/javascript">
    function getSubCategoryByMainCategory(){
      var main_cat = $("#main_cat").val();
      $.ajax({
        url: '{{url('products-getSubCategoryByMainCategory')}}',
        method: "post",
        data: {
          main_cat:main_cat,
        },
        // dataType: 'JSON',
        beforeSend: function () {
          $('#categories').prop('disabled',true);
        },
        complete: function () {
          $('#categories').prop('disabled',false);
        },
        success: function (data) {


          var options = '<option value="">--- Select Sub Category ---</option>';
          $.each( data, function( index, row ){
          console.log(row.name);
            options += '<option value="'+row.id+'">'+row.name+'</option>';
          });

          $('#sub_cat_1').html(options);
          $('#sub_cat_1').selectpicker('refresh');
        },
        error: function(data){
        }
      });
    }
</script>

<script type="text/javascript">
    function getSubCategory2BySubCategory(){
      var sub_cat_1 = $("#sub_cat_1").val();
      $.ajax({
        url: '{{url('products-getSubCategory2BySubCategory')}}',
        method: "post",
        data: {
          sub_cat_1:sub_cat_1,
        },
        // dataType: 'JSON',
        beforeSend: function () {
          $('#categories').prop('disabled',true);
        },
        complete: function () {
          $('#categories').prop('disabled',false);
        },
        success: function (data) {


          var options = '<option value="">--- Select Sub Category 2 ---</option>';
          $.each( data, function( index, row ){
          console.log(row.name);
            options += '<option value="'+row.id+'">'+row.name+'</option>';
          });

          $('#sub_cat_2').html(options);
          $('#sub_cat_2').selectpicker('refresh');
        },
        error: function(data){
        }
      });
    }
</script>
@endpush
