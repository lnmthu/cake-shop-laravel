@extends("front.layout.index")

@section("content")
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Tìm thấy {{count($prod)}} bánh</h4>
							<div class="beta-products-details">
								<p class="pull-left"></p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($prod as $p)
								@if($p->active==1)
								<div class="col-sm-3">
									<div class="single-item">
                                    @if($p->promotion_price)
										<div class="ribbon-wrapper"><p class="ribbon sale">{{"Khuyến mãi"}}</p></div>
                                    @endif
										<div class="single-item-header">
											<a href="detailproduct/{{$p->id}}"><img class='copingImg' src="image/product/{{$p->img}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$p->name}}</p>
											<p class="single-item-price">
												@if($p->promotion_price)
												<span class="flash-del">{{number_format($p->unit_price,0,"",".")}} <u>đ</u></span>
												<span class="flash-sale">{{number_format($p->promotion_price,0,"",".")}} <u>đ</u></span>
												@else
												<span class="flash-sale">{{number_format($p->unit_price,0,"",".")}} <u>đ</u></span>
												@endif
											</p>
											<br>
										</div>
										<div class="single-item-caption">
											@if($p->quantity_stock>0)
											<form>
                                                @csrf
                                           		<input type="hidden" value="1" class="qty_{{$p->id}}">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="{{$p->id}}" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/{{$p->id}}l">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
											@else
											<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
											@endif
										</div>
										<br>
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>


					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
