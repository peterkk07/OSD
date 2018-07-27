
<p>Estimado {{ $user->name }} ,</p>

<p> Para restablecer la contraseña de su cuenta, por favor haga click <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> aquí </a>
</p>