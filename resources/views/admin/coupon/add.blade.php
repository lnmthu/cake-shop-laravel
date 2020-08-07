@extends("admin.layout.index")
@section("content")
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mã giảm giá
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
                       <form action="admin/coupon/add" method="POST">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên" data-validation="required"  data-validation-error-msg="Làm ơn nhập tên mã giảm"/>
                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá</label>
                                <input class="form-control" name="code" placeholder="Nhập mã giảm giá" data-validation="required"   data-validation-error-msg="Làm ơn nhập mã giảm"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng mã</label>
                                <input class="form-control" name="qty" placeholder="Nhập số lượng mã" data-validation="number"  data-validation-error-msg="Làm ơn nhập số lượng mã"/>
                            </div>
                            <div class="form-group">
                                <label>Điều kiện</label>
                                <select id="condition" name="condition" class="form-control" data-validation="required"  data-validation-error-msg="Làm ơn chọn điều kiện giảm">
                                      <option value=""> - - Chọn điều kiện giảm - - </option>
                                        <option value="0">Giảm bằng phần trăm</option>
                                        <option value="1">Giảm bằng tiền</option>
                                </select>
                            </div>       
                            
                            <div class="form-group" >
                                <label>Số phần trăm hoặc số tiền </label>
                                <input  class="form-control option" name="number" placeholder="Nhập số phần trăm hoặc số tiền" data-validation="number"  data-validation-error-msg="Làm ơn nhập số phần trăm hoặc số tiền"/>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input  id="option1" name="active" value="0" checked="" type="radio">Không kích hoạt
                                </label>
                                <label class="radio-inline">
                                    <input  id="option2" name="active" value="1" type="radio">KÍch hoạt
                                </label>
                            </div>
                            <br>                       
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

