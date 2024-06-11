@extends("front.layout")
@section("content")
<div data-scroll-watch="" class="fade_in title">
    <div class="breadcrumbs"><a href="/">首頁</a> / <a href="/product">好茶</a> / <span>{{ $product->itemName }}</span></div>
</div>
<div id="product_detail">
    <div class="main_info">
        <div class="main_pic">
            <div class="m_pic">
                @if(!empty($photo) && sizeof($photo)>0)
                <img id="zoom_03" src="/images/product/M/{{ $photo[0]->photo }}" data-zoom-image="/images/product/{{ $photo[0]->photo }}">
            </div>
            <div id="thumb_pic">
                <ul id="gallery_01">
                    @foreach($photo as $data)
                    <li><a href="#" data-image="/images/product/M/{{ $data->photo }}" data-zoom-image="/images/product/{{ $data->photo}}">
                            <img id="zoom_03" src="/images/product/S/{{ $data->photo}}"></a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="right_info">
            <h3 class="product_tit">{{ $product->itemName }}</h3>
            <p class="subtitle">{{ $product->subName }}</p>
            <div>{!! QrCode::size(120)->generate("https://xxx/xxx") !!}</div>
            <div>{!! QrCode::size(120)->color(0, 0, 255)->generate("https://xxx/xxx") !!}</div>
            <div>{!! QrCode::size(120)->backgroundColor(0, 255, 0)->generate("https://xxx/xxx") !!}</div>
            <div>{!! QrCode::size(120)->style('dot')->generate("https://xxx/xxx") !!}</div>
            <div>{!! QrCode::size(120)->style('square')->generate("https://xxx/xxx") !!}</div>
            <div>{!! QrCode::size(120)->style('round')->generate("https://xxx/xxx") !!}</div>
            @if(!empty($spec) && sizeof($spec)>0)
            <table class="prod_table">
                @foreach($spec as $data)
                <tr>
                    <th></th>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->content }}</td>
                </tr>
                @endforeach
            </table>
            @endif

            @if(!empty($shop) && sizeof($shop)>0)
            <div class="shop_link">
                <h6>買好茶</h6>
                @foreach($shop as $data)
                <a href="{{ $data->url }}" target="blank">
                    <p>PChome</p>
                </a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- 給手機板使用的 -->
        <div class="mobile_slider">
            <!-- 小尺寸用-->
            <h3 class="product_tit">{{ $product->itemName }}</h3>
            <p class="subtitle">{{ $product->subName }}</p>
            @if(!empty($photo) && sizeof($photo)>0)
            <ul class="bx_mobile">
                @foreach($photo as $data)
                <li><img src="/images/product/{{ $data->photo }}"></li>
                @endforeach
            </ul>
            @endif

            @if(!empty($spec) && sizeof($spec)>0)
            <table class="prod_table">
                @foreach($spec as $data)
                <tr>
                    <th></th>
                    <td>{{ $data->title }}</td>
                    <td>{{ $data->content }}</td>
                </tr>
                @endforeach
            </table>
            @endif

            @if(!empty($shop) && sizeof($shop)>0)
            <div class="shop_link">
                <h6>買好茶</h6>
                @foreach($shop as $data)
                <a href="{{ $data->url }}" target="blank">
                    <p>{{ $data->title }}</p>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<h2 class="main_title">關於好茶</h2>
<div class="product_int">
    <!-- 下面為$content可以為空的，不寫這個$content為空的會出錯 -->
    {!! !empty($content) ? $content->content : "" !!}
</div>
@endsection