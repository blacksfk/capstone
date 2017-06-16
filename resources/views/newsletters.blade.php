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
            @foreach ($newsletters as $i => $nl)
                <a href="{{ asset('assets/' . $nl->type . '/' . $nl->name) }}" class="list-group-item {{ ($i === 0 ? 'active' : '' ) }}" onclick="changeNewsletter(this, event, '{{ $nl->name }}')">{{ $nl->name }}<span class="badge">{{ $i + 1 }}</span></a>
            @endforeach
            </div>         
        </div>
        <div class="col-md-8">
            <object id="newsletterObject" data="{{ asset('assets/' . $newsletters[0]->type . '/' . $newsletters[0]->name) }}" type="application/pdf" width="100%" height="800px"><p>Unfortunately your browser does not support PDFs, however, you can still download the newsletter from <a href="{{ asset('assets/' . $newsletters[0]->type . '/' . $newsletters[0]->name) }}">here</a></p></object>
        </div>
    </div>
</div>
@endsection