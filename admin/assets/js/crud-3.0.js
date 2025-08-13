class CRUD {

  constructor() {
    this.form = "formData";
    this.modal = "#formModal";
    this.submitButton = "#btnSubmit";
    this.datatables = "";
    this.url = "";
    this.refreshPage = false;
    this.update = false;
    this.id = 0;
  }

  getFromToJquery(){
    return "#"+this.form;
  }

  ajax(method , url , form, additonalData = null) {
    let formData = new FormData(document.getElementById(form));
    formData.append('_token', token);
    if (additonalData !== null) {
      this.appendAdditionaData(additonalData, formData);
    }

    if (!window.axios) {
      throw "Axios link කරලා නෑ";
    }

    axios[method](url, formData).then(res => {
      this.success(res);
    }).catch(error => {
      this.errors(error);
    });
  }

  internalAjax(method , url) {
    let formData = new FormData(document.getElementById(this.form));
    if (!window.axios) {
      throw "Axios link කරලා නෑ";
    }

    if (this.update) {
      formData.append('_method', 'PATCH');
    }
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token; // for all requests
    if(method == 'delete'){
      return axios.delete(url, { data: formData });
    }
    return axios[method](url, formData)
  }

  errors(response) {
    // console.log(response);
    if (window.$.notify !== undefined) {
      if (response.response.status !== 422) {
        $.notify({message: "Internal Error"},{type: 'danger',z_index:2000});
        return;
      }

      for (let msg in response.response.data) {
        $.notify({message: response.response.data[msg]},{type: 'danger',z_index:2000});
      }
    }
  }

  success(response) {
    if (this.refreshPage) {
      location.reload()
    }

    if (window.$.notify !== undefined) {
      $.notify({message: response.data.msg},{type: 'success',z_index:2000});
    }

    $(this.modal).modal('hide')
    this.clearFrom();
    this.datatables.draw()


  }

  appendAdditionaData(data,formData){

    if (typeof data !== 'object') {
      throw  'Addition data වලට pass කරන්න ඕනේ object එකක්';
    }

    data.forEach(field => {

      if (field.type === "file") {
        formData.append(field.fieldName , field.value , field.fileName );
      }else {
        formData.append(field.fieldName , field.value);
      }

    });
  }

  initDataTables(tableElement,options){
    if (typeof options !== "object") {
      throw 'Options වලට pass කරන්න ඕනේ object එකක්';
    }

    if (!window.jQuery) {
      throw 'Jquery link කරලා නෑ';
    }

    this.datatables = $(tableElement).DataTable(options);
  }

  initCRUDFunctions(options) {
    if (typeof options !== "object") {
      throw 'Options වලට pass කරන්න ඕනේ object එකක්';
    }

    if (!window.jQuery) {
      throw 'Jquery link කරලා නෑ';
    }

    for (let option in options) {
      if (this.hasOwnProperty(option)) {
          this[option] = options[option];
      }
    }
  }

  onclickAdd(){
    this.clearFrom();
    this.update = false;
    $(this.modal).modal('show');
  }

  onClickEdit(id, btn){
    this.clearFrom()
    $(btn).prop("disabled", true);
    this.update = true;
    this.id = id;





    this.getData(this.id).then(res => {
      $(btn).prop("disabled", false);
      this.loadDataToFrom(res.data)
      $(this.modal).modal('show')
    }).catch(error => {
      $(btn).prop("disabled", false);
      this.errors(error);
    });
  }

  onClickDelete(id , btn){
    $(btn).prop("disabled", true);
    this.submitDelete(id).then(res => {
      this.success(res);
      $(btn).prop("disabled", false);
      this.datatables.draw()
    }).catch(error => {
      $(btn).prop("disabled", false);
      this.errors(error);
    });
  }

  clearFrom() {
    let form = this.getFromToJquery();
    $(this.submitButton).prop("disabled", false);
    $(form).find('input[type="text"]').val('');
    $(form).find('input[type="email"]').val('');
    $(form).find('input[type="number"]').val('');
    $(form).find('input[type="password"]').val('');
    $(form).find('textarea').val('');
    $(form).find('input[name="_token"]').val(token);
    $(form).find('input[type="checkbox"]').attr({'checked': false});
    $(form).find('input[type="radio"]').attr({'checked': false});
    $(form).find('select').selectpicker('val', 0);
  }

  loadDataToFrom(data){
    let form = this.getFromToJquery();
    for (var input in data) {
      $('input[name="'+input+'"][type="text"]').val(data[input]);
      $('input[name="'+input+'"][type="number"]').val(data[input]);
      $('input[name="'+input+'"][type="email"]').val(data[input]);
      $('input[name="'+input+'"][type="url"]').val(data[input]);
      $('input[name="'+input+'"][type="radio"][value="'+data[input]+'"]').attr({'checked' : 'checked'})
      $('textarea[name="'+input+'"]').val(data[input]);
      $('select[name="'+input+'"]').selectpicker('val', data[input]);
    }
    //dashboar theme specific
    $('.form-line').addClass('focused');
  }

  submitData(){
    $(this.submitButton).prop("disabled", true);

    let promise;

    if (this.update) {
      promise = this.submitEdit(this.id)
    }else {
      promise = this.submitCreate()
    }

    promise.then(res => {
      $(this.submitButton).prop("disabled", false);
      this.success(res);
    }).catch(error => {
      $(this.submitButton).prop("disabled", false);
      this.errors(error);
    });
  }

  submitCreate(){
    return this.internalAjax("post", this.url);
  }

  submitEdit(id){
    return this.internalAjax("post", this.url+"/"+id);
  }

  getData(id){
    return this.internalAjax("get", this.url+"/"+id);
  }

  submitDelete(id){
    return this.internalAjax("delete", this.url+"/"+id);
  }
}
