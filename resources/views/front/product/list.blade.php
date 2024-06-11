@extends("front.layout")
@section("content")
<div data-scroll-watch="" class="fade_in title">
    <div class="breadcrumbs"><a href="index.html">首頁</a> / <span>好茶</span></div>
    <h1 class="top_title">Product</h1>
    @if(!empty($banner))
    <div class="top_banner">
        <img src="/images/banner/{{ $banner->photo}}" alt="product">
    </div>
    @endif
</div>
<div class="productlist">
    @foreach($list as $data)
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <div class="hover ehover13">
            <a href="/product/detail/{{ $data->id }}">
                <img src="/images/product/{{ $data->photo }}" class="img-responsive">
                <div class="overlay">
                    <h2>{{ $data->subName }}</h2>
                    <p>more <i aria-hidden="true" class="fa fa-leaf"></i></p>
                </div>
            </a></div>
        <p class="product_tit">{{ $data->itemName }}</p>
    </div>
    @endforeach
</div>
@endsection