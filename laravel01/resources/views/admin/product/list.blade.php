@extends("admin.app")
@section("title", "商品管理")
@section("content")
<!-- 下方為警告視窗，裡面文字使用session寫出 -->
<script>
    @if (Session::has("message"))
        Swal.fire("{{ Session::get("message")}}");
    @endif
</script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="crad-header">
                <a class="btn btn-info" href="add">新增</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-danger" href="javascript:deleteAll()">刪除</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="excel" class="btn btn-success">轉excel</a>
            </div>
        </div>
        <form method="post" action="delete" name="list">
            {{ csrf_field() }}
            <table class="table table-bordered">
                <tr style="background-color: #f5f3da;">
                    <th class="text-center">
                        <input type="checkbox" class="form-check-input" id="all">
                    </th>
                    <th class="text-center">類別</th>
                    <th class="text-center">商品編號</th>
                    <th class="text-center">品名</th>
                    <th class="text-center">標題</th>
                    <th class="text-center">使用</th>
                    <th class="text-center">首頁</th>
                    <td class="text-center">修改</td>
                    <td class="text-center">匯出</td>
                    <td class="text-center">pdf</td>
                </tr>
                @foreach($list as $data)
                <tr class="text-center">
                    <td>
                        <input type="checkbox" class="chk form-check-input" name="id[]" value="{{ $data->id }}">
                    </td>
                    <td class="text-center">{{ $data->layer1_name }}</td>
                    <td class="text-center">{{ $data->itemNo }}</td>
                    <td class="text-center">{{ $data->itemName }}</td>
                    <td class="text-center">{{ $data->subName }}</td>
                    <td class="text-center">
                        @if ($data->active == "Y")
                            <font color="blue">Y</font>
                        @else
                            <font color="red">N</font>
                        @endif
                    </td>
                    <td class="text-center">
                        @if (!empty($data->home))
                            <font color="blue">Y</font>
                        @endif
                    </td>
                    <td class="text-center"><a href="edit/{{ $data->id }}" class="btn btn-success">修改</a></td>
                    <td class="text-center"><a href="word/{{ $data->id }}" class="btn btn-info">匯出word</a></td>
                    <td class="text-center"><a href="pdf/{{ $data->id }}" class="btn btn-warning">轉pdf</a></td> 
                </tr>
                @endforeach
            </table>
        </form>
        {{ $list->links() }}
    </div>
</div>
@endsection