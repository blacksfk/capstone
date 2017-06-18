<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('shared.head')
</head>
<body>
    @include('shared.overlay_spinner')
    @include('shared.modal')
    @include('shared.navbar')
    @include('shared.messages')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">@yield('title')</h3>
                    </div>
                    <div class="panel-body">@yield('content')</div>
                    @yield('table')
                    <div class="panel-footer">@yield('form_nav')</div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('shared.footer')
    @include('shared.scripts')
    <script src="{{ asset('assets/js/admin.js') }}"></script>
</body>
</html>