@extends("admin.app")
@section("title","修改商品")
@section("content")
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#tabs").tabs();
    });

    //跳出訊息
    @if(Session::has('message'))
    Swal.fire("{{Session::get("message")}}");
    @endif

    //跳出警告視窗，詢問是否刪除
    function doDelete(formId) {
        Swal.fire({
            title: "確定刪除?",
            icon: "question",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "確定",
            denyButtonText: "取消"
        }).then((result) => {
            // 下面這行，當按下【確定】後，會執行下面的程式
            if (result.isConfirmed) {
                document.forms[formId].submit();
            }
        });
    }
</script>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">基本資料和內容</a></li>
        <li><a href="#tabs-2">商品圖</a></li>
        <li><a href="#tabs-3">規格</a></li>
        <li><a href="#tabs-4">商店</a></li>
    </ul>
    <!-- 第1格，資料和內容修改 -->
    <div id="tabs-1">
        <form method="post" action="/admin/product/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $product->id }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-1 text-right">類別</div>
                <div class="col-3">
                    <select name="layer1" class="form-control">
                        <option value=""></option>
                        @foreach($layer1 as $data)
                        <option value="{{ $data->id }}" {{ $data->id == $product->layer1 ? " selected": "" }}>
                            {{ $data->layer1_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-1 text-right">商品編號</div>
                <div class="col-2">
                    <input type="text" name="itemNo" class="form-control" value="{{ $product->itemNo }}">
                </div>
            </div>
            <div class="row">
                <div class="col-1 text-right">商品名稱</div>
                <div class="col-6">
                    <input type="text" name="itemName" class="form-control" value="{{ $product->itemName }}">
                </div>
            </div>
            <div class="row">
                <div class="col-1 text-right">標題</div>
                <div class="col-10">
                    <input type="text" name="subName" class="form-control" value="{{ $product->subName }}">
                </div>
            </div>
            <div class="row">
                <!-- 帶入addContent的程式碼 -->
                @include("admin.product.editContent");
            </div>
            <div class="row">
                <div class="col-1 text-right">首頁</div>
                <div class="col-2 mx-3">
                    <input type="checkbox" name="home" class="form-check-input" value="Y" {{ $product->home == "Y" ? " checked": "" }}>
                    <!-- {{ $product->home == "Y" ? " checked": "" }} : 如果$product的home == "Y"，那input多加checked，如果不是，多加"" -->
                </div>
            </div>
            <div class="row">
                <div class="col-1 text-right">使用中</div>
                <div class="col-2 mx-3">
                    <input type="checkbox" name="active" class="form-check-input" value="Y" {{ $product->active == "Y" ? " checked": "" }}>
                </div>
            </div>
            <div class="row">
                <div class="text-center col-4">
                    <input type="submit" value="確定" class="btn btn-primary btn-lg">
                </div>
            </div>
        </form>
    </div>
    <!-- 第2格，圖片 -->
    <div id="tabs-2">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-info" href="/admin/photo/add/{{ $product->id }}">新增</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger" href="javascript:doDelete('photo')">刪除</a>
                    </div>
                </div>
                <form method="post" action="/admin/photo/delete" name="photo">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <tr style="background-color: #f5f3da;">
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input" id="all">
                            </th>
                            <th class="text-center">圖檔</th>
                        </tr>
                        @foreach($photo as $data)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="chk form-check-input" name="photoId[]" value="{{ $data->id }}">
                            </td>
                            <td class="text-center">
                                <img src="/images/product/{{ $data->photo }}" width="100">
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- 第3格，規格 -->
    <div id="tabs-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-info" href="/admin/spec/add/{{ $product->id }}">新增</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger" href="javascript:doDelete('spec')">刪除</a>
                    </div>
                </div>
                <form method="post" action="/admin/spec/delete" name="spec">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <tr style="background-color: #f5f3da;">
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input" id="all">
                            </th>
                            <th class="text-center">規格名稱</th>
                            <th class="text-center">規格內容</th>
                            <th class="text-center">修改</th>
                        </tr>
                        @foreach($spec as $data)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="chk form-check-input" name="specId[]" value="{{ $data->id }}">
                            </td>
                            <td class="text-center">{{ $data->title }}</td>
                            <td class="text-center">{{ $data->content }}</td>
                            <td class="text-center">
                                <a href="/admin/spec/edit/{{ $product->id }}/{{ $data->id }}" class="btn btn-primary text-white">修改</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- 第4格，商店 -->
    <div id="tabs-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-info" href="/admin/productShop/add/{{ $product->id }}">新增</a> &nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-danger" href="javascript:doDelete('shop')">刪除</a>
                    </div>
                </div>
                <form method="post" action="/admin/productShop/delete" name="shop">
                    {{ csrf_field() }}
                    <table class="table table-bordered">
                        <tr style="background-color: #f5f3da;">
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input" id="all">
                            </th>
                            <th class="text-center">商店名稱</th>
                            <th class="text-center">網址</th>
                            <th class="text-center">修改</th>
                        </tr>
                        @foreach($shop as $data)
                        <tr>
                            <td class="text-center">
                                <input type="checkbox" class="chk form-check-input" name="shopId[]" value="{{ $data->id }}">
                            </td>
                            <td class="text-center">{{ $data->title }}</td>
                            <td class="text-center">{{ $data->url }}</td>
                            <td class="text-center">
                                <a href="/admin/productShop/edit/{{ $product->id }}/{{ $data->id }}" class="btn btn-primary text-white">修改</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div>
    <a href="/admin/product/list" class="btn btn-success m-3">返回上一頁</a>
</div>
@endsection