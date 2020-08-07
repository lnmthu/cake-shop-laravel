@extends("admin.layout.index")
@section("content")

 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản phẩm
                            <small>Thêm</small>
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
                    	@if(session("thongbao"))
                    		<div class="alert alert-success">
                    			{{session("thongbao")}}<br>
                    		</div>
                    	@endif
                         @if(session("loi"))
                            <div class="alert alert-danger">
                                {{session("loi")}}<br>
                            </div>
                            @endif
                            
                       <form action="admin/product/add" method="POST" enctype='multipart/form-data'>
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <select name="id_type" class="form-control" data-validation="required"       data-validation-error-msg="Làm ơn chọn loại sản phẩm">
                                      <option value=""> - - Chọn loại sản phẩm - - </option>
                                    @foreach($type as $t)
                                        <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập tên"  data-validation="required" data-validation-error-msg="Làm ơn nhập tên sản phẩm"/>
                            </div>
                            
                            <div class="form-group">
                                <label>Số lượng trong kho</label>
                                <input class="form-control" name="quantity_stock" placeholder="Nhập số lượng trong kho"  data-validation="number" data-validation-error-msg="Làm ơn nhập số lượng trong kho"/>
                            </div>
                            <div class="form-group">
                                <label>Giá gốc</label>
                                <input class="form-control" name="unit_price" placeholder="Nhập giá gốc"  data-validation="number" data-validation-error-msg="Làm ơn nhập giá gốc"/>
                            </div>
                            <div class="form-group">
                            <input type="checkbox" name="changeOption" id="changeOption">
                                <label>Giá khuyến mãi</label>
                                <input disabled="" id="promotion_price" class="form-control" name="promotion_price" placeholder="Nhập giá khuyến mãi" data-validation="number" data-validation-error-msg="Làm ơn nhập giá khuyến mãi nhỏ hơn giá gốc" />
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea  id="ckeditor" name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <textarea id="ckeditor1" name="title" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Từ khóa</label>
                                <textarea id="ckeditor2" name="keywords" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                               <input name="img" type="file"  
                                  data-validation="required"
                                  data-validation-error-msg-required='Làm ơn chọn hình ảnh có đuôi là ".jpg" hoặc ".ipeg" hoặc ".png"'>
                            </div>
                           
                           <div class="form-group">
                                <label>Trạng thái</label>
                                <br>
                                <label class="radio-inline">
                                    <input checked="" name="active" value="0" type="radio">Không kích hoạt
                                </label>
                                <label class="radio-inline">
                                    <input name="active" value="1" type="radio">Kích hoạt
                                </label>
                            </div>
                            <br>                       
                            <input type="submit" value="Thêm" class="btn btn-default">
                            <input type="reset" value="Làm mới" class="btn btn-default">
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
@section("script")
<script type="text/javascript">
    $(document).ready(function(){
        $("#changeOption").change(function(){
            if($(this).is(":checked")){
                $("#promotion_price").removeAttr("disabled");
            }
            else{
                $("#promotion_price").attr("disabled","");
            }

        });
    });
</script>
@endsection
