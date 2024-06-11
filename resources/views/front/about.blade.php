@extends("front.layout")
@section("content")
<link rel="stylesheet" type="text/css" href="/css/front/about/about.css">
<!-- timeline的 CSS-->
<link rel="stylesheet" type="text/css" href="/css/front/about/timeline.css"><!--ScrollWatch滾動淡入-->
<script src="/js/front/html2canvas.min.js"></script>
<script>
    $(document).ready(function(){
        let img = document.querySelector("#getImg");
        html2canvas(img).then(function(canvas){
            data = canvas.toDataURL("image/png");
            $.ajax({
                url: "/about/saveImg",
                type: "post",
                data: {
                    data: data,
                    _token: "{{ csrf_token() }}"
                },
                success: function(msg){

                }
            });
        });
    });
</script>
<div id="getImg"></div>
<div data-scroll-watch="" class="fade_in title">
    <div class="breadcrumbs"><a href="index.html">{{ $home->title }}</a> / <span>{{ $about->title }}</span></div>
    <h1 class="top_title">{{ $about->title }}</h1>
    @if(!empty($banner))
    <div class="top_banner">
        <img src="/images/banner/{{ $banner->photo }}" alt="About">
    </div>
    @endif
</div>

@if(!empty($content))
<div data-scroll-watch="" class="fade_in esontea">
    <section data-scroll-watch="" class="fade_in">
        <p class="subtitle">{!! $content->content !!}</p>
    </section>
</div>
@endif

@if(!empty($us))
<div data-scroll-watch="" class="fade_in content_title">
    <h2 class="main_title">{{ $about->title }}</h2>
    <div class="subtitle">{{ $about->content}}</div>
</div>
<div class="idea">
    @foreach($us as $data)
    <section data-scroll-watch="" class="fade_in">
        <img src="/images/about/{{ $data->photo }}">
        <h3 class="main_title">{{ $data->title }}</h3>
        <p class="subtitle">{{ $data->content }}</p>
    </section>
    @endforeach
</div>
@endif

@if(!empty($advance) && sizeof($advance) > 0)
<div data-scroll-watch="" class="fade_in content_title">
    <h2 class="main_title">{{ $ad->title }}</h2>
    <div class="subtitle">{{ $ad->content }}</div>
</div>
<div class="strength">
    @foreach($advance as $data)
    <section data-scroll-watch="" class="fade_in">
        @if(!empty($data->photo))
        <img src="/images/about/{{ $data->photo }}">
        @endif
        <h3 class="main_title">{{ $data->title }}</h3>
        <p class="subtitle">{{ $data->content }}</p>
    </section>
    @endforeach
</div>
@endif

@if(!empty($note) && sizeof($note) > 0)
<div data-scroll-watch="" class="fade_in content_title">
    <h2 class="main_title">{{ $line->title }}</h2>
    <div class="subtitle">{{ $line->content }}</div>
</div>
<div data-scroll-watch="" class="fade_in eson_timeline">
    <div class="col-md-12">
        <div class="main-timeline">
            @php $cnt = 0; @endphp
            @foreach($note as $data)
            @php $cnt++; @endphp
            <div class="timeline">
                <div class="timeline-icon"></div>
                <div class="timeline-content{{ $cnt % 2 == 0 ? " right" : "" }}">
                    <h2 class="title">{{ $data->years }}</h2>
                    <p class="description">{{ $data->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection