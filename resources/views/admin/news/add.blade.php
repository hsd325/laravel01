@extends("admin.app")
@section("title","新增最新消息")
@section("content")
<link rel="stylesheet" href="/css/admin/ckeditor.css">
<form method="post" action="insert" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">類別名稱</label>
                <div class="col-2 col-sm-2">
                    <select name="typeId" class="form-control" required>
                        <option value=""></option>
                        @foreach($list as $data)
                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">標題</label>
                <div class="col-4">
                    <input type="text" name="title" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">副標題</label>
                <div class="col-10">
                    <input type="text" name="subTitle" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">圖檔</label>
                <div class="col-2">
                    <input type="file" name="photo" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">內容</label>
                <div class="col-10">
                    <textarea name="content" id="editor"></textarea>
                </div>
            </div>
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 text-right">日期</label>
                <div class="col-2">
                    <input type="date" name="dates" class="form-control" required>
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<script src="/js/admin/editor.js"></script>
@endsection