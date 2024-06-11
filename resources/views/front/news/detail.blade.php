@extends("front.layout")
@section("content")
<!-- NEWS內頁的CSS -->
<link href="/css/front/news/news_detail.css" rel="stylesheet">
<div data-scroll-watch="" class="fade_in title">
      <div class="breadcrumbs"><a href="/">首頁</a> / <a href="/news">最新消息</a> / <span>免費試茶宅配到府</span></div>
    </div>
    <div class="news_detail">
      <div class="content">
        <div class="date">{{$news->dates}}</div>
        <h3 class="main_title">{{$news->title}}</h3>
        <p class="subtitle">{{$news->subTitle}}</p>
        @if(!empty($news->photo))
        <img src="/images/news/{{$news->photo}}">
        @endif
        @if(!empty($news->content))
        <p class="context">{!!$news->content!!}</p>
        @endif
      </div>
    </div>
    @endsection