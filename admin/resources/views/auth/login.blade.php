<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Log In | Jaydeck Interiors</title>
        <!-- Favicon-->
        <link rel="icon" href="../../favicon.ico" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="{{url('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{url('assets/plugins/node-waves/waves.css')}}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{url('assets/plugins/animate-css/animate.css')}}" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="{{url('assets/css/themes/all-themes.css')}}" rel="stylesheet" />


    </head>

    <body class="login-page" style="background: url(assets/img/login_back.svg) repeat-y 50% 0;  background-size: 100vw;background-position: center; ">
        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);"><b>Jaydeck Interiors</b></a>
            </div>
            <div class="card">

                <div class="body">
                    {{Form::open(array('url' => 'login'))}}
                        <div class="msg">Log in to start your session</div>


                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            @if ($errors->any())

                              {{-- @if ($errors->any())
                              <ul class="alert alert-danger">
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          @endif --}}
                              <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                   Email password did not match
                            </div>
                           @endif
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Remember Me</label>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">

                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="{{url('assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Core Js -->
        <script src="{{url('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{url('assets/plugins/node-waves/waves.js')}}"></script>

        <!-- Validation Plugin Js -->
        <script src="{{url('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>

        <!-- Custom Js -->
        <script src="{{url('assets/js/admin.js')}}"></script>
        <script src="{{url('assets/js/pages/examples/sign-in.js')}}"></script>
    </body>

</html>
