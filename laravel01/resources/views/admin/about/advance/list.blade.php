@extends("admin.app")
@section("title","關於我們-優勢管理")
@section("content")

<!-- 下方為警告視窗，裡面文字使用session寫出 -->
<script>
    @if(Session::has('message'))
        Swal.fire("{{Session::get("message")}}");
    @endif
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-info" href="add">新增</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-danger" href="javascript:deleteAll()">刪除</a>
            </div>
        </div>
        <form method="post" action="delete" name="list">
            {{ csrf_field() }}
            <table class="table table-bordered">
                <tr style="background-color: #f5f3da;">
                    <th class="text-center">
                        <input type="checkbox" class="form-check-input" id="all">
                    </th>
                    <th class="text-center">標題</th>
                    <th class="text-center">內容</th>
                    <td class="text-center">圖檔</td>
                    <td class="text-center">修改</td>
                </tr>
                @foreach($list as $data)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" class="chk form-check-input" name="id[]" value="{{ $data->id }}">
                    </td>
                    <td class="text-center">{{ $data->title }}</td>
                    <td class="text-center">{{ $data->content }}</td>
                    <td class="text-center">
                        @if(!empty($data->photo))
                            <img src="/images/about/{{ $data->photo }}" width="100">
                        @endif
                    </td>
                    <td class="text-center"><a href="edit/{{ $data->id }}" class="btn btn-success">修改</a></td>
                </tr>
                @endforeach
            </table>
        </form>
    </div>
</div>
@endsection