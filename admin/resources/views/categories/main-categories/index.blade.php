@extends('layouts.app')
@section('title', 'Categories')
@push('moreCss')

@include('includes.datatables-css')
@include('includes.form-css')
<style media="screen">
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
  .preloader-parent{
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: #eee;
    overflow: hidden;
    text-align: center;
    min-height: 280px;
  }
  .preloader-parent .preloader{
    position: relative;
    top: calc(50% - 30px);
  }
</style>
@endpush

@section('pageTitle', 'Category')

@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="block-header">
        <h2>MAIN CATEGORY MANAGEMENT</h2>
      </div>
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
              <div class="header">
                <span class="pull-right">
                  <button type="button" class="btn bg-light-blue waves-effect" id="btnCreate" data-toggle="tooltip" data-placement="left" title="" data-original-title="ADD NEW MAIN CATEGORY"><i class="material-icons">add</i></button>
                </span>
                    <h2>
                        ALL MAIN CATEGORIES
                        <small>All the main categories in the system</small>
                    </h2>
                </div>

                <div class="body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="main-category">
                        <thead>
                          <tr>
                            <th>#</th>
                            {{-- <th></th> --}}
                            <th>Name</th>
                            <th>Description</th>
                            <th>Added Date</th>
                            <th>Active</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
  @include('categories.main-categories.modal')


@endsection
@push('moreJs')
  @include('includes.form-js')
  @include('includes.datatables-js')

<script type="text/javascript">
    var action_type = '';
    var ajaxURL = base_url+"/main-category"
    var SSPEnable = true
    var opt = {
            processing: true,
            serverSide: true,
            ajax:{
                    url:'{{ url('main-category-all') }}',
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': token},
                    dataType: 'JSON',
                    beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization');
                    },
                },
            columns:[
              {data: 'DT_Row_Index', name: 'DT_Row_Index' , orderable: false, searchable: false},
              // {data: 'pro_image' , name: 'pro_image'},
              {data: 'name' , name: 'name'},
              {data: 'description' , name: 'description'},
              {data: 'Added_date' , name: 'Added_date'},
              {data: "active" ,orderable: false, searchable: false},
              {data: "action",orderable: false, searchable: false},
            ],
    }
</script>

<script src="{{ asset('assets/js/cropbox.js') }}"></script>
<script src="{{ asset('assets/js/crud-2.0.js') }}" charset="utf-8"></script>

 {{--  overiding setModal method in crudJS library  --}}
<script type="text/javascript">
    $('#btnCreate').click(function(event) {
        $("#formModal").modal('show')
    });

    function setModal(data) {

        $('.form-line').addClass('focused');
        // $('select[name="main-category"]').selectpicker('val', data.main-category);
        $('#cropped').html('<img src="../'+data.image+'" style="max-width ; 100%; max-height : 200px;">')
        $('select[name="main_image"]').selectpicker('val', data.main_image);
        $('input[name="name"]').val(data.name);
        $('#description').val(data.description);
        $('#formModal').modal('show');

    }

    //ajax request
    function ajaxCall(data,method){
        data = new FormData(document.getElementById("formCreate"));
          data.append("id", update);
        if (method == "PUT") {
          method = "POST";
          data.append("_method", "PUT");
        }
        // console.log(data)
        $('#btnSubmit').prop("disabled", true);
        $.ajax({
          url: url,
          type: method,
          headers: {'X-CSRF-TOKEN':token},
          dataType:'JSON',
          data: data,
          contentType: false,
          processData: false,
        })
        .done(function(data){

          onSuccess(data.msg);
          onLoading( $('#btnSubmit'));
          clearModal();

        })
        .fail(function(data){
          onLoading( $('#btnSubmit'));
          errorHandler(data.responseJSON)
        })
    }

    //clear model after submitting
    function clearModal() {
        update = 0
        // $('select[name="main-category"]').selectpicker('val', 0);
        $('input[name="name"]').val('');
        $('#description').val('');
        $('#btnSubmit').prop("disabled", false)
    }


</script>

<script type="text/javascript">
  $('.js-basic-example').on('click', 'input[type="checkbox"]', function(event) {
    id = $(this).val();
    active =  $(this).is(':checked') ? 1 : 0;

    $.ajax({
      url: base_url+'/main-category-active',
      type: 'POST',
      dataType: 'JSON',
      data: {_token: token,main_category_id: id,active:active}
    })
    .done(function(data) {
      $.notify({message: data.msg},{type: 'success',z_index:2000});
    })
    .fail(function(data) {
      $.each(data.responseJSON, function(index, val) {
      $.notify({message: val},{type: 'danger',z_index:2000});
      });
    })

  });
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


@endpush
