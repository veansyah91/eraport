<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Halaman Login</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel = "icon" href = "{{asset('img/yabam.ico')}}" type = "image/x-icon">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="{{asset('/img/sdit.png')}}" alt="toSchool Logo" class="rounded-circle mx-auto d-block" style="width: 50%">
            </div>
        <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg">Silakan Melakukan Login</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                        
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                        <div class="input-group-append" id="visible">
                            <div class="input-group-text" id="icon-pass">
                                
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Ingat Saya
                        </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>            <!-- /.social-auth-links -->
            </div>
        </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    
    <script type="text/javascript">

        window.addEventListener('load', async function(){
            const visible = document.getElementById('visible')
            const icon = document.getElementById('icon-pass')
            const pass = document.getElementById('password')

            icon.innerHTML = `<span class="fas fa-eye-slash"></span>`
            pass.setAttribute('type',"password")

            let slash = 0;
            visible.addEventListener('click', () => {
                if ( slash == 0 ) {
                    slash = 1
                    icon.innerHTML = `<span class="fas fa-eye"></span>`
                    pass.setAttribute('type',"text")
                } else {
                    slash = 0
                    icon.innerHTML = `<span class="fas fa-eye-slash"></span>`
                    pass.setAttribute('type',"password")
                }
            })
        })
    
    </script>
    
    </body>
</html>
