@extends("admin.app")
@section("title","修改類別")
@section("content")
<form method="post" action="/admin/banner/update" enctype="multipart/form-data">
    <!-- <form method="post" action="../update"> : 為另一種寫法-->
    <input type="hidden" name="id" value="{{ $banner->id }}">
    {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <label class="col-form-label col-1 col-sm-1 col-md-2 col-lg-1 text-right">Banner</label>
                <div class="col-2 col-sm-2">
                    <input type="file" class="form-control" name="photo">
                    <div>
                        <img src="/images/banner/{{ $banner->photo }}" width="200">
                    </div>
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