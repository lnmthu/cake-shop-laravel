<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
route::get("wellcome",function(){
	return view("welcome");
});

//ADMIN PAGE
route::group(["prefix"=>"admin","middleware"=>"authMiddle"],function(){
	route::group(["prefix"=>"typeProduct"],function(){
		route::get("list","type_productController@getList");
		route::get("add","type_productController@getAdd");
		route::post("add","type_productController@postAdd");
		route::get("edit/{id}","type_productController@getEdit");
		route::post("edit/{id}","type_productController@postEdit");
		route::get("delete/{id}","type_productController@getDelete");
	});
	route::group(["prefix"=>"product"],function(){
		route::get("list","productController@getList");
		route::get("add","productController@getAdd");
		route::post("add","productController@postAdd");
		route::get("edit/{id}","productController@getEdit");
		route::post("edit/{id}","productController@postEdit");
		route::get("delete/{id}","productController@getDelete");
	});
	route::group(["prefix"=>"bill"],function(){
		route::get("list","billController@getList");
		route::post("active","billController@active");
	});
	route::group(["prefix"=>"billDetail"],function(){
		route::get("list/{id_bill}","bill_detailController@getList");
	});
	route::group(["prefix"=>"slide"],function(){
		route::get("list","slideController@getList");
		route::get("add","slideController@getAdd");
		route::post("add","slideController@postAdd");
		route::get("edit/{id}","slideController@getEdit");
		route::post("edit/{id}","slideController@postEdit");
		route::get("delete/{id}","slideController@getDelete");
	});
	route::group(["prefix"=>"users"],function(){
		route::get("list","usersController@getList");
		route::get("add","usersController@getAdd");
		route::post("add","usersController@postAdd");
		route::get("edit/{id}","usersController@getEdit");
		route::post("edit/{id}","usersController@postEdit");
		route::get("delete/{id}","usersController@getDelete");
	});
	route::group(["prefix"=>"statistical"],function(){
		route::get("sales","statisticalController@sales");
		route::get("stocking","statisticalController@stocking");
		route::get("outofstock","statisticalController@outofstock");
	});
	route::group(["prefix"=>"coupon"],function(){
		route::get("ajax/{condition}","CouponController@getAjax");
		route::get("list","CouponController@getList");
		route::get("add","CouponController@getAdd");
		route::post("add","CouponController@postAdd");
		route::get("edit/{id}","CouponController@getEdit");
		route::post("edit/{id}","CouponController@postEdit");
		route::get("delete/{id}","CouponController@getDelete");
		route::get("active/{id}","CouponController@getActive");
	});
	route::group(["prefix"=>"feeship"],function(){
		route::get("manage","feeshipController@manage");
		route::post("choose","feeshipController@choose");
		route::post("add","feeshipController@add");
		route::post("list","feeshipController@list");
		route::post("edit","feeshipController@edit");
		route::get("delete/{id}","feeshipController@delete");
	});

});
route::get("admin","authController@getlogin");
route::post("admin/login","authController@postlogin");
route::get("admin/logout","authController@logout");
route::get("prinfBillDetail/{id_bill}","bill_detailController@prinfBillDetail");

//FRONT PAGE
route::get("home","pageController@home");
route::get("","pageController@home");
route::get("product/{id_type}","pageController@product");
route::get("detailproduct/{id}","pageController@detailproduct");
route::get("contact","pageController@contact");
route::get("about","pageController@about");
route::get("login","pageController@getlogin");
route::post("login","pageController@postlogin");
route::get("logout","pageController@logout");
route::get("signup","pageController@getsignup");
route::post("signup","pageController@postsignup");
route::get("infor","pageController@getinfor")->middleware('authFrontMiddle');
route::post("infor","pageController@postinfor");
route::get("managebill","pageController@getManageBill")->middleware('authFrontMiddle');
route::get("managebilldetail/{id}","pageController@getManageBillDetail")->middleware('authFrontMiddle');
route::get("cancelbill/{id}","pageController@cancelBill");



route::get("search","pageController@search");
route::get("cart","pageController@cart");

route::get("shoppingCart","pageController@shoppingCart");
route::post("applyCoupon","pageController@applyCoupon");


route::post("addtocart","pageController@addtocart");
route::post("checkQtyProduct","pageController@checkQtyProduct");

route::get("deltocart/{rowId}","pageController@deltocart");
route::post("delallcart","pageController@delallcart");

route::post("updateallcart","pageController@updateAllCart");


route::get("checkoutaddress","pageController@getcheckoutaddress")->middleware('authFrontMiddle');
route::post("checkoutaddress","pageController@postcheckoutaddress");
route::post("choose","pageController@choose");

route::get("checkoutfinal","pageController@getcheckoutfinal")->middleware('authFrontMiddle');
route::post("checkoutfinal","pageController@postcheckoutfinal");

//Login facebook
Route::get('loginfacebook','pageController@loginFacebook');
Route::get('login/callbackFacebook','pageController@callbackFacebook');

//Login google
Route::get('logingoogle','pageController@loginGoogle');
Route::get('login/callbackGoogle','pageController@callbackGoogle');
// use App\product;
// Route::get('model',function(){
// 	$product=[];
//         foreach(Cart::content() as $c)
//         {
//             $product[$c->id]=product::find($c->id);
//             for($i=1;$i<=$product[$c->id]->quantity_stock;$i++)
//             {
//             	echo '<pre>';
// 			    var_dump($i);
// 			    echo '</pre>';
//             }

//         }


// });













