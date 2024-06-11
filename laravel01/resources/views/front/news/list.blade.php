@extends("front.layout")
@section("content")
<link href="/css/front/news/tab.css" rel="stylesheet">
    <!-- News內頁的CSS-->
<link href="/css/front/news/news_detail.css" rel="stylesheet"><!--ScrollWatch滾動淡入-->
<script src="/js/front/product/jquery-2.1.3.min.js"></script>
<script>
    $(document).ready(function(){
        getNews();
    });
    function getNews()
    {
        let date=$("#dates").val();
        let typeId=$("#typeId").val();
        $.ajax({
            url:"/news/news",
            type:"post",
            data:{
                dates:date,
                typeId:typeId,
                _token:"{{csrf_token()}}"

            },
            success:function(msg){
                $("#list").html(msg);
            }
        });
    }

</script>
<div data-scroll-watch="" class="fade_in title">
      <div class="breadcrumbs"><a href="/">首頁</a> / <span>最新消息</span></div>
      <h1 class="top_title">News</h1>
      @if(!empty($banner))
        <div class="top_banner">
            <img src="/images/banner/{{$banner->photo}}" alt="News">
        </div>
      @endif
    <div class="abgne_tab">
      <ul class="chooes">
        <li>
          <select id="dates" onchange="getNews()">
            <option>所有年份</option>
            @foreach($date as $data)
            <option value="{{$data->year}}">{{$data->year}}</option>
           @endforeach
          </select>
        </li>
        <li>
          <select id="typeId" onchange="getNews()">
            <option value="">所有消息</option>
            @foreach($type as $data)
            <option value="{{$data->id}}">{{$data->title}}</option>
           @endforeach
          </select>
        </li>
      </ul>
      <ul class="tabs">
        <li><a href="#tab2"><i aria-hidden="true" class="fa fa-bars"></i></a></li>
        <li><a href="#tab1"><i aria-hidden="true" class="fa fa-th"></i></a></li>
      </ul>
      <div id="list"></div>
    </div>
   
    @endsection