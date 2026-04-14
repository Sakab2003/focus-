<h1>Notifications</h1>

@if($notifications->isEmpty())
    <p>Aucune notification.</p>
@else
    <ul>
        @foreach($notifications as $n)
            <li>{{ $n->message }}</li>
        @endforeach
    </ul>
@endif
