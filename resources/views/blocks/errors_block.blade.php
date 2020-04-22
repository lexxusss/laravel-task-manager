@if (@$errors && $errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@foreach (['error' => 'danger', 'warning' => 'warning', 'success' => 'success'] as $errorKey => $errorClass)
    @if ($message = Session::get($errorKey))
        @if (is_array($message))
            @foreach ($message as $m)
                @include('blocks.error_alert_block', ['errorClass' => $errorClass, 'errorValue' => $m])
            @endforeach
        @else
            @include('blocks.error_alert_block', ['errorClass' => $errorClass, 'errorValue' => $message])
        @endif
    @endif
@endforeach
