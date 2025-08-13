@extends('layouts.app')
@section('title', 'Users')
@push('moreCss')

@include('includes.datatables-css')
@include('includes.form-css')
<style media="screen">
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
          <h2>SUB CATEGORY MANAGEMENT(LEVEL 1)</h2>
        </div>
        <div class="row clearfix">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="header">
                  <span class="pull-right">
                    <button type="button" class="btn bg-light-blue waves-effect" id="btnCreate" data-toggle="tooltip" data-placement="left" title="" data-original-title="ADD NEW SUB CATEGORY"><i class="material-icons">add</i></button>
                  </span>
                      <h2>
                          ALL SUB CATEGORIES
                          <small>All the sub categories in the system</small>
                      </h2>
                  </div>

                  <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Parent</th>
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
  @include('categories.sub-categories1.modal')

@endsection
@push('moreJs')
  @include('includes.form-js')
  @include('includes.datatables-js')

<script type="text/javascript">
    var action_type = '';
    var ajaxURL = base_url+"/sub-category1"
    var SSPEnable = true
    var opt = {
            processing: true,
            serverSide: true,
            ajax:{
                    url:'{{ url('sub-category1-all') }}',
                    type:'POST',
                    headers: {'X-CSRF-TOKEN': token},
                    dataType: 'JSON',
                    beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization');
                    },
                },
            columns:[
              {data: 'DT_Row_Index', name: 'DT_Row_Index' , orderable: false, searchable: false},
              {data: 'name' , name: 'name'},
              {data: 'description' , name: 'description'},
              {data: 'parent' , name: 'parent'},
              {data: "active" ,orderable: false, searchable: false},
              {data: "action",orderable: false, searchable: false},
            ],
    }
</script>

<script src="{{ asset('assets/js/crud-2.0.js') }}" charset="utf-8"></script>

 {{--  overiding setModal method in crudJS library  --}}
<script type="text/javascript">
    $('#btnCreate').click(function(event) {
        $("#formModal").modal('show')
    });

    function setModal(data) {

        $('.form-line').addClass('focused');
        $('input[name="name"]').val(data.name);
        $('#description').val(data.description);
        $('select[name="parent"]').selectpicker('val', data.parent_id);
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
        $('input[name="name"]').val('');
        $('#description').val('');
        $('select[name="parent"]').selectpicker('val', 0);
        $('#btnSubmit').prop("disabled", false)
    }


</script>

<script type="text/javascript">
  $('.js-basic-example').on('click', 'input[type="checkbox"]', function(event) {
    id = $(this).val();
    active =  $(this).is(':checked') ? 1 : 0;

    $.ajax({
      url: base_url+'/sub-category1-active',
      type: 'POST',
      dataType: 'JSON',
      data: {_token: token,sub_category1_id: id,active:active}
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


@endpush
