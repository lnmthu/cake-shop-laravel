@extends("admin.layout.index")
@section("content")
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa đơn
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session("thongbao"))
                            <div class="alert alert-success">
                                {{session("thongbao")}}<br>
                            </div>
                        @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Số thứ tự</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày mua</th>
                                <th>Trạng thái</th>
<!--                                 <th>Chuyển trạng thái</th>
 -->                                <th>Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $b)
                            <tr class="odd gradeX" align="center">
                                <td>{{$b->id}}</td>
                                <td>{{$b->user->name}}</td>
                                <td>{{$b->date_order}}</td>
                               
                                <td>
                                   <!--  @if($b->active==1)
                                    {{"Đã xử lý"}}
                                    @else($b->active==0)
                                    {{"Chưa xử lý"}}
                                    @endif -->
                                    <form>
                                        @csrf
                                        <select @if($b->active==3) {{"disabled"}}@endif id="{{$b->id}}" name="active" class="form-control active">
                                      <option value=""> - - Chọn trạng thái - - </option>
                                    @for ($i = 0; $i <=3; $i++)
                                         <option @if($i==$b->active) {{"selected"}} @endif value="{{$i}}"> 
                                        @switch($i)
                                            @case(0)
                                                {{"Đã tiếp nhận"}}
                                                @break
                                            @case(1)
                                                {{"Đã xử lý"}}
                                            @break
                                            @case(2)
                                                {{"Giao hàng thành công"}}
                                            @break
                                            @case(3)
                                                {{"Đã hủy"}}
                                            @break
                                            @break
                                            @default
                                                @break
                                        @endswitch
                                          </option>

                                    @endfor
                                           
                                </select>
                                    </form>
                                </td>
<!--                                 <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/bill/active/{{$b->id}}">Chuyển trạng thái</a></td>
 -->                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/billDetail/list/{{$b->id}}">Xem chi tiết</a></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section("script")
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("change",".active",function(){
            var active=$(this).val();
            var id=$(this).attr("id");
            var _token=$("input[name='_token']").val();
            if(active==3)
            {
                $(this).attr("disabled","");
            }
            $.ajax({
                url:"admin/bill/active",
                method:"post",
                data:{active:active,id:id,_token:_token},
                success:function(data)
                {
                    location.reload(true);
                }

            });

        });
    });
</script>
@endsection