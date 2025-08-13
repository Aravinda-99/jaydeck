function submitBasicInfo(btn) {
  pl = new Preloader(btn)

  data = $('#basicInfoForm').serialize()
  pl.start()
  axios.post(base_url+"/profile/update", data)
  .then(res => {
    pl.stop()
    $.notify({message: res.data},{type: 'success',z_index:2000});
  })
  .catch(error => {
    pl.stop()
    if (error.response.status !== 422) {
      $.notify({message: "Internal Error"},{type: 'danger',z_index:2000});
      return;
    }

    for (let msg in error.response.data) {
      $.notify({message: error.response.data[msg]},{type: 'danger',z_index:2000});
    }
  })

}

function passwordRest(btn) {
  pl = new Preloader(btn)

  data = $('#passwordForm').serialize()
  pl.start()

  axios.post(base_url+"/user/password-rest", data)
  .then(res => {
    pl.stop()
    $.notify({message: res.data},{type: 'success',z_index:2000});

    $('#passwordForm input').val('')
  })
  .catch(error => {
    pl.stop()
    if (error.response.status !== 422) {
      $.notify({message: "Internal Error"},{type: 'danger',z_index:2000});
      return;
    }

    for (let msg in error.response.data) {
      $.notify({message: error.response.data[msg]},{type: 'danger',z_index:2000});
    }
  })

}
