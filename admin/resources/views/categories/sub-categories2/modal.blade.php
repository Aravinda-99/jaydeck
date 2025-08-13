<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="">SUB CATEGORIES(LEVEL 2)</h4>
      </div>
      <div class="modal-body">
        <div class="row clearfix">
          {!! Form::open(['name' => 'formCreate','id' => 'formCreate'])!!} 
          <div class="col-sm-12" style="margin-bottom:5%">
              <select class="form-control" name="parent" id="parent" onchange="getSubCategoryByMainCategory()">
                <option value="">Select Main Category
                </option>
                @foreach ($main_categories as $main_cat)
                <option value="{{ $main_cat->id }}">{{ $main_cat->name }}
                </option>
                @endforeach
              </select>
          </div>
          <div class="col-sm-12" style="margin-bottom:5%">
              <select class="form-control" name="sub_parent" id="sub_parent">
            </select>
          </div>
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
                      <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                      <label class="form-label">Description</label>
                  </div>
              </div>
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
