@extends("front.layout")
@section("content")
@if(!empty($banner))
<video autoplay="true" muted="true" loop="true" preload="auto" style="width: 100%; height: auto;">
    <source src="/images/banner/{{ $banner->photo }}" type="video/{{ substr($banner->photo, -3)}}">
</video>
@endif
<div class="index_banner"><img src="index/video/index_video.jpg" style="width: 100%"></div>
<div class="index-list">
    @foreach($product as $data)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="hover ehover13">
            <a href="#" onclick="doNext('{{ $data->id }}')">
                <img src="/images/product/{{ $data->photo}}" class="img-responsive">
                <div class="overlay">
                    <h2>{{ $data->subName }}</h2>
                    <p>more <i aria-hidden="true" class="fa fa-leaf"></i></p>
                </div>
            </a>
        </div>
        <p class="product_tit">{{ $data->itemName }}</p>
    </div>
    @endforeach
</div>

<script src="/js/front/product/jquery-2.1.3.min.js"></script>
<script src="/js/front/html2canvas.min.js"></script>
<script>
    function doNext(id){
        let img = document.querySelector("#getImg");
        console.log(img);
        html2canvas(img).then(function(canvas){
            data = canvas.toDataURL("image/png");
            $.ajax({
                url: "/about/saveImg",
                type: "post",
                data: {
                    data: data,
                    _token: "{{ csrf_token() }}"
                },
                success: function(msg) {
                    location.href="/product/detail/" + id
                }
            });
        });
    }
</script>
@endsection