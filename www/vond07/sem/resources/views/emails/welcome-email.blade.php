@component('mail::message')
# Vítejte na reality

Děkujeme za vaši registraci na stránce reality.

@component('mail::button', ['url' => 'https://eso.vse.cz/~vond07/www/vond07/sem/server.php'])
Zpět do aplikace
@endcomponent

Přejeme krásný den,<br>
{{ config('app.name') }}
@endcomponent
