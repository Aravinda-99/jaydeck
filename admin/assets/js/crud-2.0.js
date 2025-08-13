var datatabel
var update = 0
var lodingNoti = ""

$(window).keydown(function(event){
  if(event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});

$('#btnCreate').click(function(event) {
  $("#formModal").modal('show')
});

$('#btnSubmit').click(function(event) {

  onLoading($(this),1)

  if (update > 0) {
    url = ajaxURL+"/"+update
    method = "PUT"
  }else {
    url = ajaxURL
    method = "POST"
  }
  submitData(url,method)

});

$('#formModal').on('hidden.bs.modal', function () {
    $('.form-line').removeClass('focused')
    clearModal()
})

$('.js-basic-example').on('click', '.btn-danger', function(event) {
  event.preventDefault();

  if (confirm("Confirm delete?")) {
    onLoading($(this),1)
    id = $(this).data('id')
    url = ajaxURL+"/"+id
    submitData(url,"POST")
  }
});

$('.js-basic-example').on('click', '.btn-info', function(event) {
  event.preventDefault();

  onLoading($(this),1)

  id = $(this).data('id')
  url = ajaxURL+"/"+id
  getData(url)
  update = id
});

$(function () {
  datatabel = $('.js-basic-example').DataTable(opt);
});

function submitData(url,method) {
  formData = $('#formCreate').serializeArray()
  ajaxCall(formData,method)
}

function getData(url) {

  $.ajax({
    url: url,
    type: 'GET',
    dataType: 'JSON',
  })
  .done(function(data) {
    onLoading([],0)
    setModal(data)
  })
  .fail(function(data) {
    onLoading([],0)
    errorHandler(data.responseJSON)
  })


}


function ajaxCall(data,method) {

  $('#btnSubmit').prop("disabled", true)
  $.ajax({
    url: url,
    type: method,
    dataType: 'JSON',
    data: data
  })
  .done(function(data) {
    onLoading([],0)
    onSuccess(data.msg)
  })
  .fail(function(data) {
    onLoading([],0)
    errorHandler(data.responseJSON)
  })

}

function errorHandler(errors) {
  $('#btnSubmit').prop("disabled", false)

  if (errors === undefined) {
    $.notify({message: "Internal Error"},{type: 'danger',z_index:2000});
    return ;
  }

  $.each(errors, function(index, val) {
    $.notify({message: val},{type: 'danger',z_index:2000});
  });
}

function clearModal() {
  update = 0
  $('#btnSubmit').prop("disabled", false)
  $('#formCreate').find('input').val('')
  $('#formCreate').find('input[name="_token"]').val(token)
  $('#formCreate').find('textarea[type="text"]').val('')
  $('#formCreate').find('input[type="checkbox"]').attr({'checked': false})
  $('#formCreate').find('select').selectpicker('val', 0);
  $('input[name="_token"]').val(token)
}

function onSuccess(msg) {
 // lodingNoti.close();
  $.notify({message: msg},{type: 'success',z_index:2000});

  if (SSPEnable) {
    $('#formModal').modal('hide')
    clearModal();
    datatabel.draw()
  }else {
    location.reload()
  }
}


function onLoading(that, status) {

  if (status) {
    that.append('<img src="'+base_url+'/assets/img/loading.gif" alt="" width="20px" height="20px" id="loadingSpinner">');
  }else {
    $('#loadingSpinner').remove()
  }

}

function setModal(data) {
  $.each(data, function(index, val) {
    $('.form-line').addClass('focused');
    $('input[name="'+index+'"]').val(val);
    $('textarea[name="'+index+'"]').val(val);
    $('select[name="'+index+'"]').selectpicker('val', val);

    $('#formModal').modal('show');
  });
}
