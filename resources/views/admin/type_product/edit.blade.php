@extends("admin.layout.index")
@section("content")
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại sản phẩm
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                    	<div class="alert alert-danger"> 
                   			@foreach($errors->all() as $er)
                   				{{$er}}<br>
                   			@endforeach
                   		</div>
                    	@endif
                    	@if(session("loi"))
                    		<div class="alert alert-danger">
                    			{{session("loi")}}<br>
                    		</div>
                    	@endif
                    	@if(session("thongbao"))
                    		<div class="alert alert-success">
                    			{{session("thongbao")}}<br>
                    		</div>
                    	@endif
                       <form action="admin/typeProduct/edit/{{$type->id}}" method="POST" enctype="multipart/form-data">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên loại sản phẩm" placeholder="Nhập tên" value="{{$type->name}}" />
                            </div>
                             <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="ckeditor" name="description" class="form-control" rows="3">{{$type->description}}</textarea>
                            </div>

                            <br>                       
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
				