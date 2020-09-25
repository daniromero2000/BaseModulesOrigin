@extends('layouts.front.app')
@section('content')
<section class="header">
    <div class="w-100">
        <img src="{{asset("storage/$course->img_welcome")}}" class="img-fluid" alt="">
    </div>
</section>

<section>
    <div class="row mx-0 margin-top padding-x">
        <div class="w-100">
        <a href="{{$course->link}}">
                <img src="{{asset("storage/$course->img_button")}}" class="img-fluid" alt="">
            </a>
        </div>
    </div>

    <div class="w-100">
        <img src="{{asset("storage/$course->img_footer")}}" class="img-fluid" alt="">
    </div>
</section>

@endsection