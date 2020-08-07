@extends("front.layout.index")
@section("meta_seo")
	<meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="title" content="{{$meta_title}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />

      <meta property="og:image" content="image/product/{{$prod->img}}" />
      <meta property="og:site_name" content="http://localhost/LaravelSell/public" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" />
@endsection
@section("content")
			<!-- <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">{{$prod->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="home">Trang chủ</a> / <span>Bánh</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div> -->

	<div class="container">
		<div id="content">
			<div class="row">

				<div class="col-sm-9">
					<div class="row">
						<div class="col-sm-4">
						<div class="ribbon-wrapper"><div class="ribbon sale">@if($prod->promotion_price){{"Khuyến mãi"}}@endif</div></div>
							<img src="image/product/{{$prod->img}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$prod->name}}</p>
								<p class="single-item-price">
									@if($prod->promotion_price)
									<span class="flash-del">{{number_format($prod->unit_price,0,"",".")}} <u>đ</u></span>
									<span class="flash-sale">{{number_format($prod->promotion_price,0,"",".")}} <u>đ</u></span>
									@else
									<span class="flash-sale">{{number_format($prod->unit_price,0,"",".")}} <u>đ</u></span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet</p>
							</div>
							<div class="space20">&nbsp;</div>
							<form>
                                @csrf
								@if($prod->quantity_stock>0)
								<p>Số lượng:</p>
								<div class="single-item-options">
								<input type="number" value="1" class="wc-select qty_{{$prod->id}}">
								 <button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="{{$prod->id}}" ><i class="fa fa-shopping-cart"></i></button>  
								</div>
								@elseif($prod->quantity_stock<=0)
								<div class="alert alert-danger" >Tạm hết</div>
									<div class="clearfix"></div>
								@endif
									
							</form>	
							<br>
							<div class="fb-like" data-href="http://localhost/LaravelSell/public/detailproduct/{{$prod->id}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>	

						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							
							<p>{!!$prod->description!!}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>

						<div class="fb-comments" data-href="http://localhost/LaravelSell/public/detailproduct/{{$prod->id}}" data-numposts="20" data-width=""></div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Bánh liên quan</h4>

						<div class="row">
							@foreach($relateProd as $r)
							@if($r->active==1)
							<div class="col-sm-4">
									<div class="single-item">
										<div class="ribbon-wrapper"><div class="ribbon sale">@if($r->promotion_price){{"Khuyến mãi"}}@endif</div></div>

										<div class="single-item-header">
											<a href="detailproduct/{{$r->id}}"><img src="image/product/{{$r->img}}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$r->name}}</p>
											<p class="single-item-price">
												@if($r->promotion_price)
												<span class="flash-del">{{number_format($r->unit_price,0,"",".")}} <u>đ</u></span>
												<span class="flash-sale">{{number_format($r->promotion_price,0,"",".")}} <u>đ</u></span>
												@else
												<span class="flash-sale">{{number_format($r->unit_price,0,"",".")}} <u>đ</u></span>
												@endif
											</p>
										</div>
										<br>
										<div class="single-item-caption">
										@if($r->quantity_stock>0)
											<form>
                                                @csrf
                                           		<input type="hidden" value="1" class="qty_{{$r->id}}">
                                           		<button type="button" class="add-to-cart pull-left" name="add-to-cart" data-id_product="{{$r->id}}" ><i class="fa fa-shopping-cart"></i></button>
											</form>
											<a class="beta-btn primary" href="detailproduct/{{$r->id}}">Chi tiết bánh<i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
											@else
											<div class="alert alert-danger">Tạm hết</div>
											<div class="clearfix"></div>
											@endif
										</div>
									</div>
							</div>
							@endif
							@endforeach
						</div>
					</div> <!-- .beta-products-list -->
				</div>

				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Bánh giảm giá</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($saleProd as $s)
								@if($s->active==1)
								<div class="media beta-sales-item">
									<a class="pull-left" href="detailproduct/{{$s->id}}"><img src="image/product/{{$s->img}}" alt=""></a>
									<div class="media-body">
										{{$s->name}}
										<br>
										@if($s->promotion_price)
												<span class="flash-del">{{number_format($s->unit_price,0,"",".")}}</span>
												<span class="flash-sale">{{number_format($s->promotion_price,0,"",".")}}</span>
												@else
												<span class="flash-sale">{{number_format($s->unit_price,0,"",".")}}</span>
												@endif
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Bánh mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($newproduct as $n)
								@if($n->active==1)
								<div class="media beta-sales-item">
									<a class="pull-left" href="detailproduct/{{$n->id}}"><img src="image/product/{{$n->img}}" alt=""></a>
									<div class="media-body">
										{{$n->name}}
										<br>
										@if($n->promotion_price)
												<span class="flash-del">{{number_format($n->unit_price,0,"",".")}}</span>
												<span class="flash-sale">{{number_format($n->promotion_price,0,"",".")}}</span>
												@else
												<span class="flash-sale">{{number_format($n->unit_price,0,"",".")}}</span>
												@endif
									</div>
								</div>
								@endif
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection