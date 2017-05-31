@extends('layouts.master')
@section('title', 'Newsletters')
@section('content')

<script src="{{ asset('assets/js/newsletters.js') }}"></script>
<?php
unset($newsletters[0]);
unset($newsletters[1]);
natsort($newsletters);
?>

<div class="container set-pad">
    <div class="row text-center">
        <p>The Courtenay Gardens newsletter, known as 'Courtenay News', is produced fortnightly on a Thursday. 
            Each issue can be downloaded by clicking on the links below.</p>
    </div>
    <div class="row text-center">
        <div class="well col-sm-2">
            @foreach ($newsletters as $newsletter)
                <a class="pdfLink" href="{{ asset('assets/pdf/newsletters/'.$newsletter) }}">{{ $newsletter }}</a><br>
            @endforeach
        </div>
        
        <div class="well row col-lg-offset-3" id="pdfContainer">
            PLACEHOLDER
        </div>
    </div>
</div>
@endsection