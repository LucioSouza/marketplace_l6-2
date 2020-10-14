<h1>Olá, {{ $user->name }}, tudo certinho? Espero que que sim!</h1>

<p>
    Não deixe de conhecer os milhares de produtos em nosso marketplace!<br>
    Seu e-mail de login é: {{ $user->email }}
</p>

E-mail enviado em {{ date('d/m/Y H:i:s ') }}.
