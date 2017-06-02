@section('title', 'Preview ' . $name)
@foreach ($content as $section => $input)
    @section($section)
        {{ $input }}
    @endsection
@endforeach
<script>
    $("a, button, input[type='submit']").click(function(event) {
        event.preventDefault();
    });
</script>