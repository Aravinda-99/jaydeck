<script src="{{asset('assets/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>


@if (! \App::environment('local'))
  <script type="text/javascript">
    //disable datatables error alerts
    $.fn.dataTable.ext.errMode = 'none';

    $('.js-basic-example').on( 'error.dt', function ( e, settings, techNote, message ) {

      $.notify({message: 'Please refresh the page as there may have problem with the network'},{type: 'warning',z_index:2000});
    } ) ;
  </script>
@endif
