@extends("admin.app")
@section("title","商品管理")
@section("content")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#tabs").tabs();
    });
</script>

<form method="post" action="insert" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">基本資料</a></li>
            <li><a href="#tabs-2">商品圖</a></li>
            <li><a href="#tabs-3">規格</a></li>
            <li><a href="#tabs-4">商店</a></li>
            <li><a href="#tabs-5">內容</a></li>
        </ul>
        <div id="tabs-1">
            <div class="row">
                <div class="col-1 text-right">類別</div>
                <div class="col-3">
                    <select name="layer1" class="form-control">
                        <option value=""></option>
                        @foreach($layer1 as $data)
                        <option value="{{ $data->id}}">{{ $data->layer1_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
            <div class="col-1 text-right">商品編號</div>
            <div class="col-2"><input type="text" name="itemNo" class="form-control"></div>
            </div>
            <div class="row">
            <div class="col-1 text-right">商品名稱</div>
            <div class="col-6"><input type="text" name="itemName" class="form-control"></div>
            </div>
            <div class="row">
            <div class="col-1 text-right">標題</div>
            <div class="col-10"><input type="text" name="subName" class="form-control"></div>
            </div>
            <div class="row">
            <div class="col-1 text-right">首頁</div>
            <div class="col-2 mx-3"><input type="checkbox" name="home" class="form-check-input" value="Y"></div>
            </div>
            <div class="row">
            <div class="col-1 text-right">使用中</div>
            <div class="col-2 mx-3"><input type="checkbox" name="active" class="form-check-input" value="Y"></div>
            </div>
        </div>
        <div id="tabs-2">
            @for($i=1;$i<=5;$i++)
            <div class="form-control">
                <input type="file" name="file{{ $i }}">
            </div>
            @endfor
        </div>
        <div id="tabs-3">
            @for($i=1;$i<=10;$i++) 
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" name="title{{ $i }}" placeholder="規格名稱">
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="content{{ $i }}" placeholder="規內容">
                </div>
            </div>
            @endfor
        </div>
        <div id="tabs-4">
            @foreach($shop as $data)
            <input type="checkbox" class="form-check-input" name="shop{{ $data->id}}" value="{{ $data->id }}">
            {{ $data->title }}
            <div>網址: <input type="text" name="url{{ $data->id }}" class="form-control"></div>
            @endforeach
        </div>
        <div id="tabs-5">
            <!-- 帶入addContent的程式碼 -->
            @include("admin.product.addContent");
        </div>
    </div>
    <div class="col-12 text-center mt-3">
        <input type="submit" class="btn btn-primary btn-lg" value="確定">
    </div>
</form>
@endsection