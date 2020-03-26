form

@if( $user->inRole('Admin'))

<h1>User is Admin</h1>

    @if($user->hasAccess(['form.create']))
          <h1>user can create</h1>
        @endif
    @endif


