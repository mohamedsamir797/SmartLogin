<h2> Hello {{ $user->name }}</h2>

<p>
    please Click to Activation button to activate your account
    <a href="{{ url('/Activate/'.$user->email.'/'.$code) }}">Activate account</a>
</p>