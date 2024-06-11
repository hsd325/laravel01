@extends("admin.app")
@section("title","新增關於我們")
@section("content")
<form method="post" action="insert" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">標題</label>
                <div class="col-1">
                    <input type="number" class="form-control" name="title">
                </div>
            </div>
            <div class="row mt-3">
                <label class="col-form-label col-1 col-sm-1 text-right">內容</label>
                <div class="col-11">
                    <input type="text" class="form-control" name="content">
                </div>
            </div>
            <div class="row mt-3">
                <label class="col-form-label col-1 col-sm-1 text-right">圖檔</label>
                <div class="col-11">
                    <input type="file" class="form-control" name="photo">
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