<<<<<<< HEAD:resources/views/events.blade.php
    @extends('layouts.master')
@section('title', 'Welcome')
@section('content')
=======
<?php $__env->startSection('title', 'Welcome'); ?>
<?php $__env->startSection('content'); ?>
>>>>>>> e06d29dbd4257d54c194bfb46bf2d3b2bcbf1196:storage/framework/views/0aa1d6ea0a2ccf83a254ca3f6d08999ce43349fa.php
    <div class="row text-center">
        <div id="features-sec" class="container set-pad" >
            <div class="row text-center">
                <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                    <h1 data-scroll-reveal="enter from the bottom after 0.2s"  class="header-line">ABOUT US</h1>
                    <p data-scroll-reveal="enter from the bottom after 0.3s" >
                        Courtenay Gardens Primary School is committed to ensuring that all children have fostered in them qualities and skills which will enable them to adapt to change and be lifelong learners.
                    </p>
                </div>

                <div class="col-4" data-scroll-reveal="enter from the bottom after 0.4s">
                    <div class="about-div">
                        <i class="fa fa-paper-plane-o fa-4x icon-round-border" ></i>
                        <h3>CURRICULUMS PAGE </h3>
                        <p>
                            Grade sizes kept to a minimum<br>
                            Straight grades (where possible)<br>
                            Modern, well equipped school<br>
                            Positive attitude to the wearing of Our compulsory school uniform<br>
                            A clear code of coduct<br>
                            High academic standards<br>
                            Safe, secure environment<br>
                        </p>
                    </div>
                </div>

                <div class="col-4" data-scroll-reveal="enter from the bottom after 0.6s">
                    <div class="about-div">
                        <i class="fa fa-magic fa-4x icon-round-border" ></i>
                        <h3 >ONE TO ONE STUDY</h3>
                        <p >
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo .

                        </p>
                        <a href="#" class="btn btn-info btn-set"  >ASK THE EXPERT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>