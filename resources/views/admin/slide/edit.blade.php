@extends("admin.layout.index")
@section("content")
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    	@if(session("loi"))
                    	<div class="alert alert-danger">{{session("loi")}}</div>
                    	@endif
                    	@if(session("thongbao"))
                    	<div class="alert alert-success">{{session("thongbao")}}</div>
                    	@endif

                    <form action="admin/slide/edit/{{$slide->id}}" method="post" enctype='multipart/form-data'>
                    	@csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" value="{{$slide->name}}" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên loại sản phẩm" placeholder="Nhập tên" />
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                               <input name="img" type="file"><br>
                                  <img src="image/slide/{{$slide->img}}" width="200px">
                            </div>
                         <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <label class="radio-inline">
                                    <input @if($slide->active==0){{"checked"}}@endif name="active" value="0" type="radio">Không hiển thị
                                </label>
                                <label class="radio-inline">
                                    <input @if($slide->active==1){{"checked"}}@endif name="active" value="1" type="radio">Hiển thị
                                </label>
                            </div>
                            
                            <br>                       
                            <input type="submit"  class="btn btn-default add_slide" value="Sửa">
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                </form>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

