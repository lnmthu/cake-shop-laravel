@extends("front.layout.index")
@section("content")
	@include("front.layout.slide")
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Bánh mới nhất</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product)}} bánh</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($newproduct as $p)
								@if($p->active==1)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale">@if($p->promotion_price){{"Khuyến mãi"}}@endif</div></div>
										<div class="single-item-header">
											<a href="detailproduct/{{$p->id}}"><img class='copingImg' width="500px" src="image/product/{{$p->img}}" alt=""></a>
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
										</div>
										<br>
										@if($p->quantity_stock>0)
										<div class="single-item-caption">
											<form>
                                                @csrf
                                           		<input type="hidden" value="1" class="qty_{{$p->id}}">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="{{$p->id}}" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/{{$p->id}}l">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										@elseif($p->quantity_stock<=0)
										<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
										@endif
										<br>
									</div>
								</div>
								@endif
								@endforeach
								<div class="row" style="text-align: center;">{{$newproduct->links()}}</div>

							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Bánh ngon nhất</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product)}} bánh</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($topproduct as $t)
								@if($t->active==1)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale">@if($t->promotion_price){{"Khuyến mãi"}}@endif</div></div>

										<div class="single-item-header">
											<a href="detailproduct/{{$t->id}}"><img class='copingImg' src="image/product/{{$t->img}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$t->name}}</p>
											<p class="single-item-price">
												@if($t->promotion_price)
												<span class="flash-del">{{number_format($t->unit_price,0,"",".")}} <u>đ</u></span>
												<span class="flash-sale">{{number_format($t->promotion_price,0,"",".")}} <u>đ</u></span>
												@else
												<span class="flash-sale">{{number_format($t->unit_price,0,"",".")}} <u>đ</u></span>
												@endif
											</p>
										</div>
										<br>
										@if($t->quantity_stock>0)
										<div class="single-item-caption quantity_stock">
											<form>
                                                @csrf
                                           		<input type="hidden" value="1" class="qty_{{$t->id}}">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="{{$t->id}}" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/{{$t->id}}">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
										@elseif($t->quantity_stock<=0)
										<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
										@endif
									</div>
									<br>
								</div>
								@endif
								@endforeach
								<br>
								<div class="row" style="text-align: center;">{{$topproduct->links()}}</div>

							</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
