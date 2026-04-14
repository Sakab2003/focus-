<h1>Liste des messages reçus</h1>

@if($messages->isEmpty())
    <p>Aucun message pour le moment.</p>
@else
    <ul>
        @foreach($messages as $message)
            <li>{{ $message->content }} - Envoyé par : {{ $message->sender_id }}</li>
        @endforeach
    </ul>
@endif
