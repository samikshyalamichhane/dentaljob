@extends('front::layouts.front')
@section('content')
@section('meta_title1', @$detail->meta_title)
@section('meta_description1', @$detail->meta_description)
@section('keyword1', @$detail->keyword)

<section class="static-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="img-box mt-3">
                    <img src="{{ asset('images/main/' . @$detail->image) }}" alt="" srcset="">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="static-page-description mt-3">

                <div class="text-center">
                <h3>{{$detail->title}}</h3>

                </div>
                    <p class="mt-3">
                        {!!$detail->description!!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>





@endsection
