@extends('layouts.app')
@section('content')
<div class="container text-muted">
    <div class="row bg-white p-3 mb-4">
        <div class="col-md-3 text-center">
            <img class="profile mb-2" src="{{$data->profile->avatar}}" alt="">
        </div>
        <div class="col-md-9 text-md-right text-center">
            <h2>{{$data->name}}</h2>
            <p class="word-break">{{$data->profile->bio}}</p>
            <a href="">{{$data->profile->website}}</a>
        </div>
    </div>

    <div class="row p-3">
        <div class="col-md-12">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a href="{{route('profile',$data->id)}}" class="nav-link {{$data->relationLoaded('posts') ? 'active' : ''}}">المشاركات</a>
                </li>
                <li class="nav-item ">
                    <a href="/user/{{$data->id}}/comments" class="nav-link {{$data->relationLoaded('comments') ? 'active' : ''}}">التعليقات</a>
                </li>
            </ul>
            @if($data->relationLoaded('posts'))
            @include('user.posts_section')
        </div>
    </div>
    @else
    @include('user.comments_section')
    @endif
</div>
@endsection