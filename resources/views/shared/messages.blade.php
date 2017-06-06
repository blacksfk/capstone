<div class="container set-pad">
    @if ($success = Session::get(App\Messages::SUCCESS))
        <div class="row">
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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

    @if ($update = Session::get(App\Messages::UPDATED))
        <div class="row">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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

    @if ($warnings = Session::get(App\Messages::WARNINGS))
        <div class="row">
            <div class="alert alert-warning alert-dismissable">
                <button class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Warnings</strong>
                @if (is_array($warnings))
                    @foreach ($warnings as $w)
                        <p>{{ $w }}</p>
                    @endforeach
                @elseif (is_object($warnings))
                    @foreach ($warnings->all() as $w)
                        <p>{{ $w }}</p>
                    @endforeach
                @else
                    <p>{{ $warnings }}</p>
                @endif
            </div>
        </div>
    @endif

    @if ($errors = Session::get(App\Messages::ERRORS))
        <div class="row">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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