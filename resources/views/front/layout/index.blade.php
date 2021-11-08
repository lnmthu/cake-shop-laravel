<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield("meta_seo")
	<base href="{{asset('')}}">
	<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" href="assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/sweetalert.css">
	<link rel="stylesheet" title="style" href="assets/dest/css/style.css">


</head>
<body>

	@include("front.layout.header")

	@yield("content")

	@include("front.layout.footer")
	@include("front.layout.copyright")


	<!-- include js files -->
	<script src="assets/dest/js/jquery.js"></script>
	<script src="assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="assets/dest/vendors/bxslider/jquery.bxslider.min.js"></script>
	<script src="assets/dest/vendors/colorbox/jquery.colorbox-min.js"></script>
	<script src="assets/dest/vendors/animo/Animo.js"></script>
	<script src="assets/dest/vendors/dug/dug.js"></script>
	<script src="assets/dest/js/scripts.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	<script src="assets/dest/js/waypoints.min.js"></script>
	<script src="assets/dest/js/wow.min.js"></script>
	<!--customjs-->
	<script src="assets/dest/js/custom2.js"></script>
	<script src="assets/dest/js/sweetalert.js"></script>
		<!--Facebook-->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v7.0"></script>
	<!--capcha-->
	    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<script type="text/javascript">
        $(document).ready(function($){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var qty = $('.qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/addtocart')}}',
                    method: 'POST',
                    data:{id:id,qty:qty,_token:_token},
                    success:function(data)
                    {
                    	if(data==1)
                    	{
                    		swal({
	                              title: "Không đủ số lượng để bán",
	                             text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
	                             type:"warning",
								  showCancelButton: true,
	                              cancelButtonText: "Xem tiếp",
								  confirmButtonClass: "btn-warning",
	                              confirmButtonText: "Đi đến giỏ hàng",
								  closeOnConfirm: false
								},
								function() {
	                                window.location.href = "{{url('/shoppingCart')}}";
	                            });
                    	}else{
	                    	swal({
	                              title: "Đã thêm sản phẩm vào giỏ hàng",
	                             text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
								  type: "info",
								  showCancelButton: true,
	                              cancelButtonText: "Xem tiếp",
								  confirmButtonClass: "btn-primary",
	                              confirmButtonText: "Đi đến giỏ hàng",
								  closeOnConfirm: false
								},
								function() {
	                                window.location.href = "{{url('/shoppingCart')}}";
	                            });
	                    	$(".cart").html(data);
                    	}
                    }
                });
            });
        });
    </script>

	@yield("script")

</body>
</html>
