@component('mail::message')
Hello, {{ $user->username }}

Today, {{ $num }} quizzes have been created.

Sincerely,<br>
{{ config('app.name') }}
@endcomponent
