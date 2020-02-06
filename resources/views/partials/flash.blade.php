@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
    <div class="alert alert-{{ $key }} alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{ Session::get($key) }}
    </div>
 @endif
@endforeach