@extends("admin.layout.index")
@section("content")
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Phí vận chuyển
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
                    	<form>
                    		@csrf
                            <div class="form-group">
                                <label>Tỉnh/Thành phố</label>
                                <select name="id_city" id="city" class="form-control choose" data-validation="required"  data-validation-error-msg="Làm ơn chọn tỉnh thành phố">
                                    	<option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach($city as $c)
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group">
                                <label>Quận/Huyện</label>
                                <select name="id_district" id="district" class="form-control choose" data-validation="required"  data-validation-error-msg="Làm ơn chọn quận huyện">
                                    <option value="">--Chọn quận huyện --</option>
                                </select>
                            </div>    
                            <div class="form-group">
                                <label>Phường/Xã/Thị trấn</label>
                                <select name="id_ward" id="ward" class="form-control" data-validation="required"  data-validation-error-msg="Làm ơn chọn xã phường thị trấn">
                                    <option value="">--Chọn xã phường thị trận--</option>
                                </select>
                            </div>                               
                            <div class="form-group">
                                <label>Phí</label>
                                <input class="form-control" name="fee" id="fee" placeholder="Nhập tên" data-validation="number"  data-validation-error-msg="Làm ơn nhập phí"/>
                            </div>
                           
                            <br>                       
                            <button type="button" id="btn_add_fee" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    <div id="list"></div>
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
    	list();
    	function list(){
    		var _token = $('input[name="_token"]').val();
        $.ajax({
              url:'{{url('admin/feeship/list')}}',
              method:"POST",
              data:{_token:_token},
              success:function(data){
                $("#list").html(data);
              }

           });
    		};
      $(document).on('click','.delete_fee',function(){
          var id=$(this).data("delete_fee_id");
          var _token=$("input[name='_token']").val();
          $.ajax({
            url:"admin/feeship/delete",
            method:"post",
            data:{id:id,_token:_token},
            success:function(data){
                list();
            }

          });
        });
      $(document).on('blur','.edit_fee_id',function(){
        var id =$(this).data("fee_id");
        var fee =$(this).text();
        var _token =$("input[name='_token']").val();
        $.ajax({
              url:'{{url('admin/feeship/edit')}}',
              method:"POST",
              data:{id:id,fee:fee,_token:_token},
              success:function(data){
                list();
              }

           });
      });

      $("#btn_add_fee").click(function(){
      	var id_city= $("#city").val();
      	var id_district= $("#district").val();
      	var id_ward= $("#ward").val();
      	var fee= $("#fee").val();
        var _token = $('input[name="_token"]').val();
      	$.ajax({
           		url:'{{url('admin/feeship/add')}}',
           		method:"POST",
           		data:{id_city:id_city,id_district:id_district,id_ward:id_ward,fee:fee,_token:_token},
           		success:function(data){
               
           			list();
           		}

           });
  	});
      $(".choose").change(function(){
         var action= $(this).attr("id");
         var id =$(this).val();
         var result="";
         var _token = $('input[name="_token"]').val();
         if(action=="city"){
         		result="district";
         }else{
         		result="ward";
         }
         $.ajax({
         		url:'{{url('admin/feeship/choose')}}',
         		method:"POST",
         		data:{action:action,id:id,_token:_token},
         		success:function(data){
         			$("#"+result).html(data);
         		}

         });

      });
    });
</script>
@endsection
