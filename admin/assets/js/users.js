var datatabel

$('#btnCreate').click(function(event) {
  // datatabel.draw()
  $("#userCreate").modal('show')
});

$('#btnSubmit').click(function(event) {
  url = base_url+"/add-user"
  submitData(url)
});

$(function () {
  datatabel = $('.js-basic-example').DataTable({
      responsive: true
  });
});

function submitData(url) {
  formData = $('#formCreate').serializeArray()
  callback = ajaxCall(url,formData)

  if (callback) {
    $('.modal').modal('hide')
  }
}

function ajaxCall(url,data) {

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'JSON',
    data: data
  })
  .done(function() {
    $.notify({message: "User Has been saved"},{type: 'success',z_index:2000});
    return true
  })
  .fail(function(data) {
    errorHandler(data.responseJSON)
    return false
  })

}

function errorHandler(errors) {
  $.each(errors, function(index, val) {
    $.notify({message: val},{type: 'danger',z_index:2000});
  });
}
