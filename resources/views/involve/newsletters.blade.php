@extends('layouts.master')
@section('title', 'Enrolment')
@section('content')
<div class="container set-pad">
<div class="row text-center">
    <h1 class="header-line text-center">Newsletters</h1>
    
    <p>The Courtenay Gardens newsletter, known as 'Courtenay News', is produced fortnightly on a Thursday. 
    Each issue can be downloaded by clicking on the links below.</p>
    
    <p><strong>Please Note:</strong> Adobe Reader is required to view these .pdf files. 
    The latest version can be downloaded free by visiting www.adobe.com</p>
    
    <?php 
    $datetime = getdate();
    $year = $datetime['year'];
    echo($year)
    ?>
    
    <p>newsletters...</p>
</div>
</div>
@endsection