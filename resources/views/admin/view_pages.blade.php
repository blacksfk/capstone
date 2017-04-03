@extends('layouts.admin')
@section('title', 'Welcome')
@section('content')
    <div class="container set-pad" >
        @include('shared.sidebar')
        <div class="well row text-center col-lg-offset-3">
        <?php
        {
        $full_path = resource_path().'\\views\\';
            if(!is_dir($full_path))
            return $full_path;
        $files = scandir($full_path);
            foreach($files AS $file){
                echo $file;
                }
            echo "===== SCAN DIR FULL PATH ====";
        unset($files[0]);
        unset($files[1]);
            foreach($files AS $file){
                echo $file;
             }
            echo "===== AFTER UNSET ====";
        if(($key = array_search('emails', $files)) !== false) {
            echo $files[$key];
            unset($files[$key]);
            echo "===== BEFORE UNSET KEY====";
            echo $files[$key];
        }
        foreach($files AS $file){
        $link = str_replace('.blade.php','',$file);
        echo '<a href="'.$link.'">'.$link.'</a>'.'<br>';
        }
        }
        ?>
            </div>
    </div>
@endsection