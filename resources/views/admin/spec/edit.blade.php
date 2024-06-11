@extends("admin.app")
@section("title","修改規格")
@section("content")
<form method="post" action="/admin/spec/update">
    <input type="hidden" name="itemId" value="{{ $itemId }}">
    <input type="hidden" name="id" value="{{ $id }}">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">規格名稱</label>
                <div class="col-2 col-sm-2">
                    <input type="text" class="form-control" name="title" value="{{ $spec->title }}">
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">規格內容</label>
                <div class="col-10 col-sm-10">
                    <input type="text" class="form-control" name="content" value="{{ $spec->content }}">
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