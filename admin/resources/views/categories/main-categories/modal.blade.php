<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">Main Category</h4>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
          {!! Form::open(['name' => 'formCreate','id' => 'formCreate'])!!}
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
                      <textarea name="description" class="form-control" rows="3" id="description"></textarea>
                      <label class="form-label">Description</label>
                  </div>
              </div>
          </div>

          <div class="col-sm-12">
            <div class="container-fluid">
              {{-- <span style="color:red">*</span> --}}
              <label class="control-label">Category Main Image</label>
              <div class="imageBox">
                <div class="thumbBox"></div>
                <div class="spinner" style="display: none">Loading...</div>
              </div>
              <div class="action">
                <input type="file" id="file" style="float:left; width: 250px">
                <button type="button" id="btnCrop"  style="float: right"><span id="loading"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></span> Crop</button>
                <input type="button" id="btnZoomIn" value="+" style="float: right">
                <input type="button" id="btnZoomOut" value="-" style="float: right">
              </div>

              <input type="hidden" id="main_image"  name="main_image" form="formCreate"  value="">
            </div>
            <div class="cropped col-xs-12" id="cropped">
          </div>

          {!! Form::close()!!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btnSubmit">SUBMIT
        </button>
      </div>
    </div>
  </div>
</div>