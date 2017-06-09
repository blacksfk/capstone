@extends('layouts.master')
@section('title', 'Newsletters')
@section('content')

<div class="container set-pad">
    <div class="row text-center">
        <p>The Courtenay Gardens newsletter, known as 'Courtenay News', is produced fortnightly on a Thursday. 
            Each issue can be downloaded by clicking on the links below.</p>
    </div>
    <div class="row text-center">
        <div class="col-sm-1"></div>
        <div class="well col-sm-2">
            @foreach ($newsletters as $newsletter)
                <a class="pdfLink" href="{{ asset('assets/' . $newsletter->type . '/' . $newsletter->name) }}">{{ $newsletter->name }}</a><br>
            @endforeach
        </div>

        <div class="col-sm-1"></div>

        <div class="well row col-sm-7" id="pdfContainer">
            select an issue on the left to begin!
        </div>
        <div class="col-sm-1"></div>
    </div>
</div>
@endsection