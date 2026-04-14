<h1>Mes messages envoyés</h1>

@if($messages->isEmpty())
    <p>Aucun message envoyé pour le moment.</p>
@else
    <ul>
        @foreach($messages as $m)
            <li>
                <strong>À l'enseignant {{ $m->receiver->nom }}</strong><br>
                {{ $m->content }}
            </li>
        @endforeach
    </ul>
@endif
