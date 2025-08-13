
function onSuccess(msg,refresh) {
 // lodingNoti.close();
  $.notify({message: msg},{type: 'success',z_index:2000});

  if (refresh) {
    $('#formModal').modal('hide')
    clearModal();
  }else {
    location.reload()
  }
}

function errorHandler(errors) {
  $.each(errors, function(index, val) {
    $.notify({message: val},{type: 'danger',z_index:2000});
  });
}


function clearModal(btn) {
  $('#formCreate').find('input').val('')
  $('#formCreate').find('input[name="_token"]').val(token)
  $('#formCreate').find('textarea[type="text"]').val('')
  $('#formCreate').find('input[type="checkbox"]').attr({'checked': false})
  $('#formCreate').find('select').selectpicker('val', 0);
  $('input[name="_token"]').val(token)
}


function onLoading(btn, status) {

  if (status) {
    btn.attr({'disabled' : 'disabled' })
    btn.append('<img src="'+base_url+'/assets/img/loading.gif" alt="" width="20px" height="20px" id="loadingSpinner">');
  }else {
    btn.removeAttr('disabled')
    $('#loadingSpinner').remove()
  }

}
