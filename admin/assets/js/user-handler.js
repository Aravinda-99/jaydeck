const crud = new CRUD()
const url = base_url+"/user";
const datatablesObject = {
  el : ".dataTable",
  processing: true,
  serverSide: true,
  ajax:{
        url: url+"/data",
        type:'POST',
        headers: {'X-CSRF-TOKEN': token},
        dataType: 'JSON',
        beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization');
        }
      },
  columns:[
    {data: 'id' , name: 'id',"visible": false,orderable: true},
    {data: 'name' , name: 'name'},
    {data: 'roles' , name: 'roles',orderable: false, searchable: false},
    {data: 'phone_no' , name: 'phone_no'},
    {data: 'email' , name: 'email'},
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

  $('input[name="name"]').val(data.name);
  $('input[name="phone_no"]').val(data.phone_no);
  $('input[name="email"]').val(data.email);
  $('input[name="name"]').val(data.name);
  $('select[name="role[]"]').selectpicker('val', roles);
}

crud.initDataTables(datatablesObject.el, datatablesObject);
crud.initCRUDFunctions(crudInit);
