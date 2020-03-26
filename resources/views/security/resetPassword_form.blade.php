@extends('template')




@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="/register" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">

                    <h2 class="form-title">Reset Password</h2>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-danger">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form  action="{{ url('/resetPassword/'.$user->email.'/'.$code) }}" method="POST" class="register-form" id="login-form">
                        @csrf

                        @if(count($errors) > 0 )
                            <div class="alert alert-success">
                                @foreach( $errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                            @endif

                        @if(session('success'))

                            <div class="alert alert-success">
                              {{ session('success') }}
                            </div>

                            @endif

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="password" name="password" id="password" placeholder="password"/>
                        </div>

                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="password_confirm"/>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="change" id="signin" class="form-submit" value="Change password"/>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

@endsection



