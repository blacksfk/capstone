
@section('title', $page->name)
@foreach ($page->content as $section => $content)
    @section($section)
        {{ $content }}
    @endsection
@endforeach