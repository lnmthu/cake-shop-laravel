<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\slide;
use App\bill;
use App\bill_detail;
use App\product;
use App\type_product;
use App\User;
use Cart;
use Mail;
use Socialite;
use App\Social;
use App\Rules\Captcha;
use App\coupon;
use App\feeship;
use App\city;
use App\district;
use App\ward;
use App\address;
use Illuminate\Routing\Route;
use App\Notifications\OrderSuccess;
class pageController extends Controller
{
    public function __construct()
    {

        if(Auth::check())
        {
            $s=Social::where('id_user',Auth::user()->id)->first;
            if($s)
                view()->share('s',$s);
        }
        $slide=slide::all();
        $product=product::where("active",1)->get();
        $type=type_product::where("active",1)->get();
        $coupon=coupon::where("active",1)->get();
        view()->share('slide',$slide);
        view()->share('type',$type);
        view()->share('product',$product);
        view()->share('coupon',$coupon);

    }
    public function choose(Request $r)
    {
       if($r->action=='city')
        {
            $output="<option value=''> - - Chọn quận huyện - - </option>";
            $district=district::where('id_city',$r->id)->get();
            foreach ($district as $d) {
                $output.="<option value='".$d->id."'>".$d->name."</option>";
            }

        }
        else
        {
            $output="<option value=''> - - Chọn xã phường thị trấn - - </option>";
            $ward=ward::where('id_district',$r->id)->get();
             foreach ($ward as $w) {
                $output.="<option value='".$w->id."'>".$w->name."</option>";
             }
        }
         echo $output;
    }
    public function home()
    {
        dd('hello');
        $newproduct=product::orderby('created_at','desc')->where('active',1)->paginate(4,['*'], 'pag');
        $topproduct=product::orderby('unit_price','desc')->where('active',1)->paginate(4);
        return view('front.page.home',['newproduct'=>$newproduct,'topproduct'=>$topproduct]);
    }
    public function product(Request $r,$id_type)
    {
        $type=type_product::find($id_type);
        $meta_desc=$type->description;
        $meta_keywords=$type->keyword;
        $meta_title=$type->title;
        $name_type=$type->name;
        $url_canonical=$r->url();
        $newproduct=product::where('id_type',$id_type)->where('active',1)->orderby('created_at','desc')->paginate(4,['*'], 'pag');
        $topproduct=product::where('id_type',$id_type)->where('active',1)->orderby('unit_price','desc')->paginate(4);
        return view('front.page.product')->with(compact('name_type','newproduct','topproduct','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
    public function detailproduct(Request $r,$id)
    {
        $prod=product::find($id);
        if($prod->active==0)
            return redirect()->back();
        $meta_desc=$prod->description;
        $meta_keywords=$prod->keywords;
        $meta_title=$prod->title;
        $url_canonical=$r->url();
        $img_og=url('image/product/'.$prod->img);
        $relateProd=product::where('id_type',$prod->id_type)->where('active',1)->take(3)->get();
        $saleProd=product::orderby('promotion_price','desc')->where('active',1)->take(4)->get();
        $newproduct=product::orderby('created_at','asc')->where('active',1)->take(4)->get();
        return view('front.page.detailproduct',['prod'=>$prod,'relateProd'=>$relateProd,'saleProd'=>$saleProd,'newproduct'=>$newproduct])->with(compact('meta_desc','meta_keywords','url_canonical','meta_title','img_og'));
    }
    public function contact()
    {
        return view('front.page.contact');
    }
    public function about()
    {

        return view('front.page.about');
    }
    public function search(Request $r)
    {
        $prod=product::where('name','like',"%$r->search%")->orwhere('description','like',"%$r->search%")->orwhere('unit_price','like',"%$r->search%")->orwhere('promotion_price','like',"%$r->search%")->get();
        return view('front.page.search',['prod'=>$prod,'key'=>$r->search]);
    }
    public function getsignup()
    {
        if(Auth::check())
            return redirect("infor");
        $city=city::all();
        return view('front.page.signup',["city"=>$city]);
    }
    public function postsignup(Request $r)
    {
         $this->validate($r,
                        [
                            'email'=>'required|unique:users',
                            'name'=>'required',
                            'password'=>'required|min:6|max:32',
                            'passwordAgain'=>'same:password',
                            'phone_number'=>'required',
                            'address'=>'required',
                            'g-recaptcha-response' => new Captcha(),

                        ],
                        [
                            'email.required'=>'Bạn chưa email',
                            'email.unique'=>'Email đã đăng ký',
                            'name.required'=>'Bạn chưa nhập tên',
                            'password.required'=>'Bạn chưa nhập mật khẩu',
                            'password.min'=>'Độ dài của mật khẩu phải từ 6 đến 32 ký tự',
                            'password.max'=>'Độ dài của mật khẩu phải từ 6 đến 32 ký tự',
                            'phone_number.required'=>'Bạn chưa nhập số điện thoại',
                            'address.required'=>'Bạn chưa nhập địa chỉ',
                        ]);
        $user=new User();
        $user->email=$r->email;
        $user->name=$r->name;
        $user->password=bcrypt($r->password);
        $user->phone_number=$r->phone_number;
        $user->address=$r->address;
        $user->gender=$r->gender;
        $user->id_city=$r->id_city;
        $user->id_district=$r->id_district;
        $user->id_ward=$r->id_ward;
        $user->save();
        return redirect('signup')->with('thongbao','Đăng ký thành công');
    }
     public function getlogin()
    {
        if(Auth::check())
            return redirect("infor");
        return view('front.page.login');
    }

    public function postlogin(Request $r)
    {
        // $data = $r->validate(['g-recaptcha-response' => new Captcha(),]);
        if(Auth::attempt(['email'=>$r->email,'password'=>$r->password]))
        {
             if(Cart::count()>0)
                return redirect('shoppingCart');
            return redirect('home');
        }
        return redirect('login')->with('thongbao','Đăng nhập không thành công');
    }
    public function logout()
    {
        Auth::logout();
        if(session('social'))
            session()->forget('social');
        return redirect('');
    }
    public function getinfor()
    {
        $city=city::all();
        if(Auth::check()){
            return view('front.page.infor',['city'=>$city]);
        }
        return redirect('');
    }

    public function postinfor(Request $r)
    {
         $this->validate($r,
                        [
                            'name'=>'required',
                            'email'=>'required',
                            'phone_number'=>'required',
                            'address'=>'required',
                            'g-recaptcha-response' => new Captcha(),

                        ],
                        [
                            'name.required'=>'Bạn chưa nhập tên',
                            'email.required'=>'Bạn chưa nhập email',
                            'phone_number.required'=>'Bạn chưa nhập số điện thoại',
                            'address.required'=>'Bạn chưa nhập địa chỉ',
                        ]);
        $user=User::find(Auth::user()->id);
        $user->name=$r->name;
        $user->email=$r->email;
        $user->phone_number=$r->phone_number;
        $user->id_city=$r->id_city;
        $user->id_district=$r->id_district;
        $user->id_ward=$r->id_ward;
        $user->address=$r->address;
        $user->gender=$r->gender;
        if(!session('social'))
        {
            $this->validate($r,
                        [
                            'password'=>'required|min:6|max:32',
                            'passwordAgain'=>'same:password',
                        ],
                        [
                            'password.required'=>'Bạn chưa nhập mật khẩu',
                            'password.min'=>'Độ dài của mật khẩu phải từ 6 đến 32 ký tự',
                            'password.max'=>'Độ dài của mật khẩu phải từ 6 đến 32 ký tự',
                        ]);
            $user->password=bcrypt($r->password);
        }
        $user->save();
        return redirect('infor')->with('thongbao','Sửa thành công');
    }
    public function getManageBill()
    {

        $bill=bill::where("id_user",Auth::user()->id)->orderby("id","desc")->paginate(4);
        return view('front.page.managebill',["bill"=>$bill]);

    }
    public function getManageBillDetail($id)
    {
        $bill=bill::find($id);
        $bill_detail=bill_detail::where("id_bill",$id)->get();
        return view('front.page.managebilldetail',["bill_detail"=>$bill_detail,"bill"=>$bill]);

    }
    public function cancelBill($id)
    {
        $bill=bill::find($id);
        $bill->active=3;
        $bill->save();
        foreach ($bill->bill_detail as $detail) {
            $product=product::find($detail->id_product);
            $product->quantity_stock+=$detail->quantity;
            $product->quantity_sold-=$detail->quantity;
            $product->save();
        }
        return redirect()->back();
    }


    public function addtocart(Request $r)
    {
        $prod=product::find($r->id);
        $data['id']=$r->id;
        $data['qty']=$r->qty;
        $data['name']=$prod->name;
        $data['price']=$prod->unit_price;
        if($prod->promotion_price)
            $data['price']=$prod->promotion_price;
        $data['weight']=0;
        $data['options']['img']=$prod->img;
        Cart::add($data);


                // <div class='cart'>
        $d="
                   <div class='beta-select'><i class='fa fa-shopping-cart'></i>Giỏ hàng (".Cart::count()." Bánh)</div>";
        //                     <div class='cart-body' >";
        //                         foreach(Cart::content() as $c)
        //                         {
        //                             $d.="<div class='beta-dropdown cart-item'>
        //                                         <div class='media'>
        //                                             <a class='pull-left' href='detailproduct/".$c->id."'><img src='image/product/".$c->options->img."' alt=''></a>
        //                                             <div class='media-body'>
        //                                                 <span class='cart-item-title'>".$c->name."</span>
        //                                                 <span class='cart-item-amount'>.".$c->qty."*<span>".$c->price."</span></span>
        //                                             </div>
        //                                         </div>
        //                                      </div>";
        //                         }
        // $d.="
        //                         <div class='cart-caption'>
        //                             <div class='cart-total text-right'>Tổng tiền: <span class='cart-total-value'>".Cart::priceTotal(0)." VND</span></div>
        //                             <div class='clearfix'></div>

        //                             <div class='center'>
        //                                 <div class='space10'>&nbsp;</div>
        //                                 <a href='shoppingCart' class='beta-btn primary text-center'>Đặt hàng <i class='fa fa-chevron-right'></i></a>
        //                             </div>
        //                         </div>
        //                     </div>
        //         </div>";
            if(Cart::count()>0)
            {
                foreach (Cart::content() as  $c) {
                    if($c->id==$prod->id)
                        if($c->qty>$prod->quantity_stock)
                        {
                            echo 1;die();
                        }
                }
            }
            echo $d;
        }



     public function deltocart($rowId)
    {
        Cart::remove($rowId);
        if(session("coupon_id"))
        {
            $coupon=coupon::find(session("coupon_id"));
            if((int)Cart::priceTotal(0,'','') < $coupon->bill_price)
            {
                session()->forget('priceTotalAfterApply');
                session()->forget('coupon_number');
                session()->forget('coupon_id');
            }
            else
            {
                if($coupon->number<=100)
                    $coupon_number=((int)Cart::priceTotal(0,'','') * $coupon->number)/100;
                else
                {
                    $coupon_number=$coupon->number;
                    $priceTotalAfterApply=(int)Cart::priceTotal(0,'','')-$coupon_number;
                    session()->put('priceTotalAfterApply',$priceTotalAfterApply);
                    session()->put('coupon_number',$coupon_number);
                }


            }
        }
        return redirect()->back();
    }
     public function delallcart(Request $r)
    {
        session()->forget('priceTotalAfterApply');
        session()->forget('coupon_number');
        session()->forget('coupon_id');
        Cart::destroy();
        return redirect()->back();

    }

    public function updateAllCart(Request $r)
    {

            $rowId=$r->rowId;
            $qty=(int)$r->qty;
            $prod=product::find(Cart::get($rowId)->id);
            if($qty>$prod->quantity_stock)
            {
                Cart::update($rowId, $prod->quantity_stock);
                echo $prod->quantity_stock;
            }else{
                Cart::update($rowId, $qty);
            }
    }
    public function shoppingCart()
    {
        $product=[];
        foreach (Cart::content() as $c) {
            $product[$c->id]=product::find($c->id);
            if($c->qty>$product[$c->id]->quantity_stock)
            {
                Cart::update($c->rowId, $product[$c->id]->quantity_stock);
            }
        }
        if(session("code"))
            $this->cacularCoupon();

        return view("front.page.shoppingCart",["product"=>$product]);

    }
     public function cacularCoupon()
     {
        $coupon=coupon::where('code',session("code"))->first();
        if($coupon->number<=100)
                $coupon_number=((int)Cart::priceTotal(0,'','') * $coupon->number)/100;
            else
                $coupon_number=$coupon->number;
            $priceTotalAfterApply=(int)Cart::priceTotal(0,'','')-$coupon_number;
            session()->put('priceTotalAfterApply',$priceTotalAfterApply);
            session()->put('coupon_number',$coupon_number);
            session()->put('coupon_id',$coupon->id);
     }
    public function applyCoupon(Request $r)
    {
        session()->put("code",$r->code);
        if(!Auth::check())
            return redirect("login");
        $coupon=coupon::where('code',session("code"))->first();
        $bill=bill::where("id_user",Auth::user()->id)->where("id_coupon",$coupon->id)->first();
        if($bill || !$coupon || $coupon->active==0)
            return redirect('shoppingCart')->with('loi','Mã giảm giá '.$coupon->code.' đã sử dụng hoặc không tồn tại');
        if($coupon->qty>0 && $coupon->bill_price <= (int)Cart::priceTotal(0,'',''))
        {
            $this->cacularCoupon();
            return redirect('shoppingCart')->with('thongbao','Mã giảm giá đã được áp dụng');
        }
        if($coupon->qty<0)
            return redirect('shoppingCart')->with('loi','Số lượng mã giảm giá đã hết');
        return redirect('shoppingCart')->with('loi','Mã giảm giá chỉ áp dụng cho hoá đơn từ '.$coupon->bill_price.' đ');

    }


     public function getcheckoutaddress()
    {
        $city=city::all();
        return view('front.page.checkoutaddress',['city'=>$city]);
    }
    public function postcheckoutaddress(Request $r)
    {
        if(Cart::count()==0)
            return redirect('shoppingCart')->with('loi','Vui lòng mua ít nhất 1 bánh');
        $this->validate($r,
                        [
                            'name'=>'required',
                            'email'=>'required',
                            'phone_number'=>'required',
                            'address'=>'required',
                            'id_city'=>'required',
                            'id_district'=>'required',
                            'id_ward'=>'required',
                        ],
                        [
                            'name.required'=>'Bạn chưa nhập tên',
                            'email.required'=>'Bạn chưa nhập email',
                            'phone_number.required'=>'Bạn chưa nhập số điện thoại',
                            'address.required'=>'Bạn chưa nhập địa chỉ',
                            'id_city.required'=>'Bạn chưa chọn tỉnh/thành phố ',
                            'id_district.required'=>'Bạn chưa chọn quận/huyện',
                            'id_ward.required'=>'Bạn chưa chọn xá/phường/thị trấn',
                        ]);
        $user=User::find(Auth::user()->id);
        $user->name=$r->name;
        $user->email=$r->email;
        $user->phone_number=$r->phone_number;
        $user->gender=$r->gender;
        $user->address=$r->address;
        $user->id_city=$r->id_city;
        $user->id_district=$r->id_district;
        $user->id_ward=$r->id_ward;
        $user->save();


        return redirect('checkoutfinal');
    }
    public function getcheckoutfinal()
    {
        foreach (Cart::content() as $c) {
            $product=product::find($c->id);
            if($c->qty>$product->quantity_stock){
                Cart::update($c->rowId, $product->quantity_stock);
            }
        }
        if(session("code"))
            $this->cacularCoupon();
        if(Auth::user()->id_city && Auth::user()->id_district && Auth::user()->id_ward)
        {
            $feeship=feeship::all();
            $fee=10000;
            foreach ($feeship as  $f) {
                if($f->id_city==Auth::user()->id_city &&
                    $f->id_district==Auth::user()->id_district &&
                            $f->id_ward==Auth::user()->id_ward)
                    $fee=$f->fee;
            }
            if((int)Cart::priceTotal(0,'','')>500000)
                $fee=0;
            if(session('coupon_number'))
                $total_price_final=(int)Cart::priceTotal(0,'','') - session('coupon_number')+$fee;
            else
                $total_price_final=(int)Cart::priceTotal(0,'','') +$fee;

            return view('front.page.checkoutfinal',['fee'=>$fee,'total_price_final'=>$total_price_final]);
        }
        return redirect("checkoutaddress");
    }
    public function postcheckoutfinal(Request $r)
    {
       //var_dump((int)Cart::priceTotal(0,'',''));die();
        $bill=new bill();
        $bill->id_user=Auth::user()->id;
        $bill->total_price_final=$r->total_price_final;
        $bill->payment=$r->payment_method;
        $bill->id_coupon=$r->id_coupon;
        $bill->note=$r->note;
        $bill->feeship=$r->feeship;
        $bill->total_price_first=(int)Cart::priceTotal(0,'','');
        if($r->id_coupon)
            $bill->id_coupon=$r->id_coupon;
        $bill->save();
        $cart=Cart::content();
         foreach ($cart as $value) {
            $bill_detail=new bill_detail();
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$value->id;
            $bill_detail->quantity=$value->qty;
            $bill_detail->unit_price=$value->price;
            $bill_detail->save();
            $product=product::find($value->id);
            $product->quantity_stock-=$value->qty;
            $product->quantity_sold+=$value->qty;
            $product->save();
        }
        $coupon=coupon::find(session("coupon_id"));
        if($coupon)
        {
            $coupon->qty--;
            $coupon->save();
        }
        $user=Auth::user();

        session()->forget('priceTotalAfterApply');
        session()->forget('coupon_number');
        session()->forget('coupon_id');
        session()->forget('code');
        Cart::destroy();

        if($user->email){
            $data = ['billId'=>$bill->id,'fee'=>$r->feeship,'total_price_final'=>$r->total_price_final,"bill"=>$bill];
            $user->notify(new OrderSuccess($data));
            // $this->sendmail(Auth::user()->email,'Xác nhận đơn hàng #'.$bill->id,'front.page.sendmail',);

            return redirect('checkoutfinal')->with('thongbao','Đặt hàng thành công.
                                                    SellCake đã gửi thông tin đơn hàng đến email <i style="color:blue; text-transform: lowercase;">'. $user->email.
                                                    '</i><br>Vui lòng kiểm tra thông tin đơn hàng tại <a style="color:blue;" href="managebill">đây</a>');
        }
        return redirect('checkoutfinal')->with('thongbao','Đặt hàng thành công. Tài khoản của bạn không có email để SellCake có thể gửi thông tin đơn.
                                                    <br>Vui lòng kiểm tra thông tin đơn hàng tại <a style="color:blue;href="managebill">Đây</a>');
    }
//     public function sendmail($to_email,$subject,$body,$data, Request $request)
//     {

//         // Mail::send($body,$data,function($message) use($to_email,$subject){
//         //      $message->to($to_email)->subject($subject);//send this mail with subject
//         //     $message->from('minhthu512586@gmail.com');//send from this mail
//         // })->queue;
//         Mail::to($request->user())->queue(new OrderSuccess($data));
//     }
//    //  //login facebook
    public function loginFacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackFacebook(){
      return $this->loginSocial('facebook');
    }
   //login google
    public function loginGoogle(){
        return Socialite::driver('google')->redirect();
   }
    public function callbackGoogle(){
       return $this->loginSocial('google');
    }
    //function login social
    public function loginSocial($name){
        $provider = Socialite::driver($name)->stateless()->user();
        $account = Social::where('name',$name)->where('id',$provider->id)->first();
        if($account){
            Auth::attempt(['email'=>$account->user->email,'password'=>'']);
            session()->put('social',$account->id);
        }else{
            $user = new User();
            $user->name=$provider->name;
            $user->email=$provider->email;
            $user->password=bcrypt('');
            $user->save();
            $Social = new Social();
            $Social->id=$provider->id;
            $Social->name=$name;
            $Social->id_user=$user->id;
            $Social->save();
            Auth::attempt(['email'=>$user->email,'password'=>'']);
            session()->put('social',$Social->id);
        }
        if(Cart::count()>0)
                return redirect('shoppingCart');
        return redirect('home');
      }

}


