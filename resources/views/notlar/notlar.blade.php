
@foreach($notlar as $not) 
<li class="media">
    <div class="mr-3">
    <button type="button" id="{{ $not->id }}" class="btn btn-outline-danger btn-sm deleteNot"></i> Sil</button>
    </div>

    <div class="media-body">
    <div class="media-chat-item">{{ $not->not }}</div>
    <div class="font-size-sm text-muted mt-2"> {{ $not->username }} </div>
    </div>
</li>
@endforeach
