<h2> Hello {{ $user->name }}</h2>

<p> please click the password reset button to reset your password
<a href="{{ url('resetPassword/'.$user->email.'/'.$code)}}" class="btn btn-primary">Resetpassword</a>
</p>