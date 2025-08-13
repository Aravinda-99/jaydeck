<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jaydeck Interiors</title>
    <link rel="icon" type="image/jpg" href="{{ url('assets/img/apple-touch-icon.png') }}" />
    <!-- custom styles -->
    <link href="{{URL::asset('assets/css/myStyle.css')}} " rel="stylesheet" />

	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

		<!-- Bootstrap Core Css -->
    <link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    
    <!-- Waves Effect Css -->
    <link href="{{URL::asset('assets/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{URL::asset('assets/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="{{URL::asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{URL::asset('assets/css/themes/all-themes.css')}}" rel="stylesheet" />

    <style>
      .slimScrollBar{
        width: 15px !important;
      }
    </style>
    <script type="text/javascript">
        base_url = "{{ url('/') }}"
        token = "{{ csrf_token() }}"
    </script>

    @stack('moreCss')

</head>
<body class="theme-black">
  @include('includes.header')
  @include('includes.sidebar')

	@yield('content')

  @include('user.profile')
  @include('includes.footer')

	<!-- Jquery Core Js -->
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>

  <!-- Bootstrap Core Js -->
  <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

  <!-- Select Plugin Js -->
  <!-- <script src="{{URL::asset('assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script> -->

  <!-- Slimscroll Plugin Js -->
  <script src="{{URL::asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

  <!-- Waves Effect Plugin Js -->
  <script src="{{URL::asset('assets/plugins/node-waves/waves.js')}}"></script>

  <!-- SweetAlert Plugin Js -->
  <script src="{{URL::asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Custom Js -->
  <script src="{{URL::asset('assets/js/admin.js')}}"></script>

  <!-- Demo Js -->
  <script src="{{URL::asset('assets/js/demo.js')}}"></script>

  {{-- lodash --}}
  <script src="{{ asset('assets/js/lodash.min.js') }}" charset="utf-8"></script>

  {{-- axios --}}
  <script src="{{ asset('assets/js/axios.min.js') }}" charset="utf-8"></script>

  <script src="{{ asset('assets/js/preloader.js') }}" charset="utf-8"></script>

  <script src="{{ asset('assets/plugins/bootstrap-notify/bootstrap-notify.min.js') }}" charset="utf-8"></script>

  <script src="{{ asset('assets/js/crud-3.0.js') }}" charset="utf-8"></script>

  <script src="{{ asset('assets/js/profile.js') }}" charset="utf-8"></script>

  <script src="{{ asset('assets/js/pages/ui/tooltips-popovers.js') }}" charset="utf-8"></script>


  @if (session('msg'))
  <script type="text/javascript">
      $.notify({message: '{{ session('msg') }}'},{type: '{{ session('type') }}',z_index:2000});
  </script>
  @endif

   @if ($errors->any())
   <script type="text/javascript">
     @foreach ($errors->all() as $error)
      $.notify({message: '{{  $error }}'},{type: 'danger',z_index:2000});
     @endforeach
   </script>
   @endif
   <script type="text/javascript">
   $.ajaxSetup({
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });
   </script>
@stack('moreJs')


</body>
</html>
