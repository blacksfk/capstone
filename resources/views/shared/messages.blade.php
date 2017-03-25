<div class="container set-pad">
    @if ($success = Session::get("success"))
        <div class="row">
            <div class="alert alert-success">
                <strong>Success</strong>
                @if (is_array($success))
                    @foreach ($success as $s)
                        <p>{{ $s }}</p>
                    @endforeach
                @elseif (is_object($success))
                    @foreach ($success->all() as $s)
                        <p>{{ $s }}</p>
                    @endforeach
                @else
                    <p>{{ $success }}</p>
                @endif
            </div>
        </div>
    @endif

    @if ($update = Session::get("update"))
        <div class="row">
            <div class="alert alert-info">
                <strong>Updated</strong>
                @if (is_array($update))
                    @foreach ($update as $u)
                        <p>{{ $u }}</p>
                    @endforeach
                @elseif (is_object($update))
                    @foreach ($update->all() as $u)
                        <p>{{ $u }}</p>
                    @endforeach
                @else
                    <p>{{ $update }}</p>
                @endif
            </div>
        </div>
    @endif

    @if ($errors = Session::get("errors"))
        <div class="row">
            <div class="alert alert-danger">
                <strong>Errors</strong>
                @if (is_array($errors))
                    @foreach ($errors as $e)
                        <p>{{ $e }}</p>
                    @endforeach
                @elseif (is_object($errors))
                    @foreach ($errors->all() as $e)
                        <p>{{ $e }}</p>
                    @endforeach
                @else
                    <p>{{ $errors }}</p>
                @endif
            </div>
        </div>
    @endif
</div>

{{-- <pre>{{ var_dump(Session::all()) }}</pre> --}}