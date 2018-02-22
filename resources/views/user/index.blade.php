@extends('user.master')
@section('content')
        <div class="am-u-md-8 am-u-sm-12 index" id="index">
            @foreach($posts as $post)
            <article class="am-g blog-entry-article">
                <div class="am-u-lg-3 am-u-md-12 am-u-sm-12 blog-entry-img">
                    <img src="{{$post->p_image}}" alt="/post/{{$post->id}}" class="blog-entry-img"  >
                </div>
                <div class="am-u-lg-9 am-u-md-12 am-u-sm-12 blog-entry-text">
                    <span> {{$post->category->cname}}&nbsp;</span>
                    <span>{{$post->created_at->toFormattedDateString()}}</span>
                    <span>
                        @foreach($post->tags as $tag)
                            <span class="label label-sm label-danger">{{$tag->name}}</span>
                        @endforeach
                    </span>
                    <h1><a href="/post/{{$post->id}}">{{str_limit($post->title,20,'...')}}</a></h1>
                    <p>{{str_limit( strip_tags($post->content),50,'...')}}
                    </p>
                </div>
            </article>
            @endforeach
             {{$posts->links()}}
        </div>
@endsection