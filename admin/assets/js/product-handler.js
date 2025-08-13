const crud = new CRUD()
const url = base_url+"/products";
const datatablesObject = {
  el : ".dataTable",
      // "pagingType": "input",
      processing: true,
      serverSide: true,
      ajax:{
        url: url+"/data",
        type:'POST',
        headers: {'X-CSRF-TOKEN': token},
        dataType: 'JSON',
        beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization');
        },
        data: function(data){
          data.status = $('#statusFilter').val()
        }
      },
      columns:[
      {data: 'DT_Row_Index' , name: 'DT_Row_Index',orderable: true},
      {data: 'pro_image' , name: 'pro_image', searchable: true},
      {data: 'name' , name: 'name', searchable: true},
      {data: 'code' , name: 'code', searchable: true},
        // {data: 'description' , name: 'description'},
        {data: 'main_cat' , name: 'main_cat'},
        {data: 'sub_cat_1' , name: 'sub_cat_1'},
        // {data: 'sub_cat_2' , name: 'sub_cat_2'},
        // {data: 'sub_cat_3' , name: 'sub_cat_3'},
        {data: 'qty' , name: 'qty'},
        {data: 'pro_price' , name: 'pro_price'},
        {data: "active" ,orderable: false, searchable: false},
        {data: "action",orderable: false, searchable: false},
        ],
      }
      const crudInit = {
        url : url,
        modal : '#formModal',
        refreshPage : false,
      form: 'formData', //should pass the id with out #
      submitButton: '#btnSubmit',
    }

    //Overiding the loadDataToFrom method to customerize
    crud.loadDataToFrom = function (data) {
      let pivot = _.map(data.roles, 'pivot');
      let roles = _.map(pivot, 'role_id');

      $('.form-line').addClass('focused');

      // $('#cropped').html('<img src="../'+data.image+'" style="max-width ; 100%; max-height : 200px;">')
    }

    crud.initDataTables(datatablesObject.el, datatablesObject);
    crud.initCRUDFunctions(crudInit);

    $('.js-basic-example').on('click', 'input[type="checkbox"]', function(event) {
      id = $(this).val();
      status =  $(this).is(':checked') ? 1 : 0;

      $.ajax({
        url: base_url+'/product-active',
        type: 'POST',
        dataType: 'JSON',
        data: {_token: token,product_id: id,status:status}
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

    $('#submitDtPageNumber').click(function(){
      let page_number = 0;
      let input_page_number = $('#dtPageNumber').val();
      if(input_page_number != ""){
        page_number = parseInt(input_page_number) - 1;
      }
      crud.datatables.page( page_number ).draw(false);
    });

    function productImage(id){
      $.ajax({
        url: base_url+'/product-image',
        type: 'POST',
        dataType: 'JSON',
        data: {_token: token,product_id: id}
      })
      .done(function(data) {
        console.log(data);
        $.each( data, function( key, value ) {
          if(value.image_type == "main"){
            $('#cropped').html('<img src="../'+value.img_src+'" style="max-width ; 100%; max-height : 200px;">');
          }else if(value.image_type == "sub"){
            var image = '../'+value.img_src;
        // addBulkImage(image);
        addOldBulkImage(value.product_id,image);
      }
    });

      })
      .fail(function(data) {
        $.each(data.responseJSON, function(index, val) {
          $.notify({message: val},{type: 'danger',z_index:2000});
        });
      })
    }

    $('#formModal').on('hidden.bs.modal', function () {
      $('#cropped').html('');
      $( "#imagesBundleContent" ).empty();
    });


  // clear filter input
  $('#btnClearFilter').click(function(event){
    // $('.filter').val('')
    $('#statusFilter').selectpicker('val', "")
    crud.datatables.draw();
  });

  $('.filter').on('change',function(event) {
      event.preventDefault();
      crud.datatables.draw();
    });

