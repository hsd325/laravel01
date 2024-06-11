@extends("admin.app")
@section("title","新增商品商店")
@section("content")
<form method="post" action="/admin/productShop/insert">
    <input type="hidden" name="itemId" value="{{ $itemId }}">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">商店</label>
                <div class="col-2 col-sm-2">
                    <select name="shopId" required>
                        <option value="">請選擇商店</option>
                        @foreach($list as $data)
                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">網址</label>
                <div class="col-10">
                    <input type="text" name="url" class="form-control" required>            
                </div>
            </div>
            <div class="mt-3 row text-center">
                <div class="col-2 col-sm-2 text-center">
                    <button class="btn btn-primary" type="submit">確定</button>
                </div>
                <div class="col-2 col-sm-2 text-center">
                    <button class="btn btn-warning" type="button" onclick="javascript:history.go(-1)">取消</button>
                    <!-- 上面這一行，歷史紀錄往回走，回上一頁 -->
                </div>
            </div>
        </div>
    </div>
</form>
@endsection