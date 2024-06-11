@extends("admin.app")
@section("title","新增Banner")
@section("content")
<form method="post" action="insert" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">位置</label>
                <div class="col-2 col-sm-2">
                    <select name="apId" required class="form-control">
                        <option value="">請選擇</option>
                        <option value="0">首頁</option>
                        @foreach($ap as $data)
                        <option value="{{ $data->id }}">{{ $data->app }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <label class="col-form-label col-1 col-sm-1 text-right">檔案</label>
                <div class="col-2 col-sm-2">
                    <input type="file" name="photo" class="form-control">
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