@if(session('success'))
    <div class="callout callout-success">
        <h4>Success</h4>
        {!! session('success') !!}
    </div>
@endif

@if(session('error'))
    <div class="callout callout-danger">
        <h4>Error</h4>
        {!! session('error') !!}
    </div>
@endif
