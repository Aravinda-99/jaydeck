$('.js-basic-example').on('click', 'input[type="checkbox"]', function(event) {
  id = $(this).val();
  active =  $(this).is(':checked') ? 1 : 0;

  $.ajax({
    url: base_url+'/user-active',
    type: 'POST',
    dataType: 'JSON',
    data: {_token: token,user_id: id,active:active}
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