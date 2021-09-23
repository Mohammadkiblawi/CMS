@extends('layouts.app')
@section('content')
<div class="col-md-8">
    <div class="content bg-white p-5">
        <h2 class="my-4">
            {{$post->title}}
        </h2>
        <img src="{{$post->image_path}}" alt="" class="card-img-top mb-4">
        {{$post->body}}
        <!--Comments Form-->
        <div class="row form-group mt-5">
            <div class="col-lg-11 col-md-6 col-xs-11">
                <h3>التعليقات :</h3>
                <form action="{{route('comment.store')}}" id="comments" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" row="5" name="body"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال</button>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form>
            </div>

        </div>
    </div>
    <div id="comments" class="word-break container mt-5">
        @foreach($post->comments as $comment)

        @include('comments.post_comments')
        @endforeach

    </div>
</div>
@include('partials.sidebar')
@endsection