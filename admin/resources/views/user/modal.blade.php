<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">USER</h4>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
          {!! Form::open(['id' => 'formData'])!!}
          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" class="form-control" name="name">
                      <label class="form-label">Name</label>
                  </div>
              </div>
          </div>
          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="email" class="form-control" name="email">
                      <label class="form-label">Email</label>
                  </div>
              </div>
          </div>
          <div class="col-sm-12" style="margin-bottom:5%">
              <select class="form-control show-tick" name="role[]" multiple>
                @foreach ($roles as $record)
                <option value="{{ $record->id }}">{{ $record->title }}</option>
                @endforeach
            </select>
          </div>

          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="text" class="form-control" name="phone_no">
                      <label class="form-label">Phone No</label>
                  </div>
              </div>
          </div>
          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="password" class="form-control" name="password">
                      <label class="form-label">Password</label>
                  </div>
              </div>
          </div>
          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line">
                      <input type="password" class="form-control" name="password_confirmation">
                      <label class="form-label">Password Confirmation</label>
                  </div>
              </div>
          </div>
          <div class="col-sm-12">
              <div class="form-group form-float">
                  <div class="form-line warning ">
                      <input type="password" class="form-control" name="admin_password">
                      <label class="form-label">Admin Password</label>
                  </div>
              </div>
          </div>
          {!! Form::close()!!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSubmit" onclick="crud.submitData()">SUBMIT
        </button>
      </div>
    </div>
  </div>
</div>
