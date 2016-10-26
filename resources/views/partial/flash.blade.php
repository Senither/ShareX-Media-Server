@if(! flash()->isEmpty())
    @foreach(flash()->all() as $message)
        <div class="alert alert-{{ $message['level'] }}" role="alert">
            <p>
                <strong>{{ $message['title'] }}</strong>
                <br>{!! $message['message'] !!}
            </p>
        </div>
    @endforeach
@endif