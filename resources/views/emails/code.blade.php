@component('mail::message')
<br>
    <h1>{!! $details['title'] !!}</h1>
    <p>Votre code est : {!! $details['code'] !!}</p>
    <p>Le code expire dans 2 minutes</p>
     
<p>Merci</p>
<p>L’équipe du Prix Pierre Castel</p> 
@endcomponent