@extends('layouts.master')
@section('title', 'Newsletters')
@section('content')

<div class="container set-pad">
    <div class="row text-center">
        <p>The Courtenay Gardens newsletter, known as 'Courtenay News', is produced fortnightly on a Thursday. 
            Each issue can be downloaded by clicking on the links below.</p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                <a href="{{ asset('assets/' . $newsletters[0]->type . '/' . $newsletters[0]->name) }}" class="list-group-item active" onclick="changeNewsletter(this, event, '{{ $newsletters[0]->name }}')">
                    <h4>{{ $newsletters[0]->name }}</h4>
                    {{-- <p>{{ $newsletters[0]->description }}</p> --}}
                    <p>placeholder description</p>
                </a>
            @for ($i = 1; $i < count($newsletters); $i++)
                <a href="{{ asset('assets/' . $newsletters[$i]->type . '/' . $newsletters[$i]->name) }}" class="list-group-item" onclick="changeNewsletter(this, event, '{{ $newsletters[$i]->name }}')">
                    <h4>{{ $newsletters[$i]->name }}</h4>
                    {{-- <p>{{ $newsletters[$i]->description }}</p> --}}
                    <p>placeholder description</p>
                </a>
            @endfor
            </div>         
        </div>
        <div class="col-md-8">
            <object id="newsletterObject" data="{{ asset('assets/' . $newsletters[0]->type . '/' . $newsletters[0]->name) }}" type="application/pdf" width="100%" height="800px"><p>Unfortunately your browser does not support PDFs, however, you can still download the newsletter from <a href="{{ asset('assets/' . $newsletters[0]->type . '/' . $newsletters[0]->name) }}">here</a></p></object>
        </div>
    </div>
</div>
@endsection