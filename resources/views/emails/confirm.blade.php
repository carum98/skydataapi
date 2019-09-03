Hola {{$user->name}}

Por favor confirme su cambio de correo electronico usando el siguiente enlace:

{{route('verify', $user->verification_token)}}