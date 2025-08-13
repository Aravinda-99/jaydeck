<div class="modal fade" id="userProfile" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Profile</h4>
      </div>
      <div class="modal-body">
        <div class="body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#home" data-toggle="tab">BASIC</a></li>
                <li role="presentation"><a href="#password" data-toggle="tab">PASSWORD</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                    <b>Basic info</b>

                    <form id="basicInfoForm">
                      <br>
                      <div class="col-sm-12">
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                                  <label class="form-label">Name</label>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
                                  <label class="form-label">Email</label>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="text" class="form-control" name="phone_no" value="{{ auth()->user()->phone_no }}">
                                  <label class="form-label">Phone No</label>
                              </div>
                          </div>
                      </div>
                      <button type="button" class="btn btn-primary" onclick="submitBasicInfo($(this))">SUBMIT
                      </button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="password">
                    <b>Reset password</b>
                    <form id="passwordForm">
                      <br>
                      <div class="col-sm-12">
                          <div class="form-group form-float">
                              <div class="form-line">
                                  <input type="password" class="form-control" name="old_password">
                                  <label class="form-label">Old Password</label>
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

                      <button type="button" class="btn btn-primary" onclick="passwordRest($(this))">SUBMIT
                      </button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
