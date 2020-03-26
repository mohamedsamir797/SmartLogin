@extends('template')




@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="/register" class="signup-image-link">Create an account</a>
                </div>

                <div class="signin-form">

                    <h2 class="form-title">Forget Password</h2>

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
                    <form  action="/forgetpassword" method="POST" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="email" id="email" placeholder="Your email"/>
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

