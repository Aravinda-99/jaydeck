
$(document).on('ready', function() {
  $('#imagesBulkUploadInput').on('change', function () { readBulkImages(this); });
  $('.old-bulk-images').each(function(){
    var image = $(this).val();
    var id = $(this).attr('data-id');
    addOldBulkImage(id,image);
  });
});

function readBulkImages(input) {

  var max_count = $(input).attr('data-max-count');

  var filesAmount = input.files.length;

  for (i = 0; i < filesAmount; i++) {

    var image = input.files[i];

    var reader = new FileReader();

    reader.onload = function(event) {
      addBulkImage(event.target.result);
    }
    reader.readAsDataURL(input.files[i]);
  }
}

function addBulkImage(image){

  var template = '<div class="image-bulk-preview-cont">'+
  '<div class="row no-gutters image-bulk-preview">'+
  '<div class="col-md-3">'+
  '<div class="image-bulk-preview-image" style="background-image: url('+image+');"></div>'+
  '<input type="hidden" name="bulk_image[]" value="'+image+'">'+
  '</div>'+
  '<div class="col-md-9" style="padding-left: 10px;">'+
  '<br>'+
  '<div class="image-bulk-preview-remove-cont">'+
  '<a href="#" style="color: inherit;" onclick="removeBulkImage(event,this)"><i class="fas fa-minus-circle"></i>'+
  'Remove</a>'+
  '</div>'+
  '</div>'+
  '</div>';

  $('#imagesBundleContent').append(template);

}

function addOldBulkImage(id,image){

  var template = '<div class="image-bulk-preview-cont">'+
  '<div class="row no-gutters image-bulk-preview">'+
  '<div class="col-md-3">'+
  '<div class="image-bulk-preview-image" style="background-image: url('+image+');"></div>'+
  // '<input type="hidden" name="old_bulk_image[]" value="'+image+'">'+
  '<input type="hidden" name="old_bulk_image_id[]" value="'+id+'">'+
  '</div>'+
  '<div class="col-md-9" style="padding-left: 10px;">'+
  '<br>'+
  '<div class="image-bulk-preview-remove-cont">'+
  '<a href="#" style="color: inherit;" onclick="removeBulkImage(event,this)"><i class="fas fa-minus-circle"></i>'+
  'Remove</a>'+
  '</div>'+
  '</div>'+
  '</div>';

  $('#imagesBundleContent').append(template);

}

function removeBulkImage(event,element){
  event.preventDefault();
  $(element).closest('.image-bulk-preview-cont').remove();
}