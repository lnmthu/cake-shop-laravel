<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill_detail;
use App\bill;
use PDF;
class bill_detailController extends Controller
{
    public function getList($id_bill)
	{
		$bill=bill::find($id_bill);
		return view('admin.bill_detail.list',['bill'=>$bill]);
	}  	

	public function prinfBillDetail($id_bill)
	{
		$pdf= \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->prinfBillDetailCovert($id_bill));
		return $pdf->stream();
	}
	public function prinfBillDetailCovert($id_bill)
	{
		 $bill=bill::find($id_bill);
		
        $output="<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><centerCông ty TNHH một thành viên ABCD</center></h1>
		<h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
		<p>Người đặt hàng</p>
		<table class='table-styling'>
				<thead>
					<tr>
                        <th>Tên khách hàng</th>
                        <th>E-mail</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Cách thức thanh toán</th>
                        <th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>";
				
		$output.="		
					<tr>
							<td>".$bill->user->name."</td>
                            <td>".$bill->user->email."</td>
                            <td>".$bill->user->phone_number."</td>";
                            if($bill->user->id_city && $bill->user->id_district && $bill->user->id_ward)
                                $output.="<td>".$bill->user->address.', '.$bill->user->ward->name.', '.$bill->user->district->name.', '.$bill->user->city->name."</td>";
                            else
                            	$output.="<td></td>";
                            $output.="<td>".$bill->payment."</td>
                            <td>".$bill->note."</td>
						
					</tr>";	

		$output.='				
				</tbody>
			
		</table>

		<p>Đơn hàng đặt</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Số thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá gốc</th>
                        <th>Giá khuyến mãi</th>
                        <th>Số lượng mua</th>
                        <th>Tổng tiền</th>
                        <th>Mã giảm giá</th>
					</tr>
				</thead>
				<tbody>';	
						 foreach($bill->bill_detail as $d)
                            {
                            	$output.="
                            <tr>
                                <td>".$d->id."</td>
                                <td>".$d->product->name."</td>
                                <td>".number_format($d->product->unit_price)." VND</td>";
                                if($d->product->promotion_price)
	                            	$output.="
	                                <td>".number_format($d->product->promotion_price)." VND</td>
	                                <td>".$d->quantity."</td>
	                                <td>".number_format($d->product->promotion_price*$d->quantity)." VND</td>";
                                else

	                            	$output.="
	                                <td></td>
	                                <td>".$d->quantity."</td>
	                                <td>".number_format($d->product->unit_price*$d->quantity)." VND</td>";
                                 if($bill->id_coupon)
	                            $output.="
                                <td>".$bill->coupon->name."</td>";
                                else
	                            $output.="
                                <td></td>
                            </tr>";
							}
		

			
		$output.="</tbody> </table><br>Tạm tính: ". number_format($bill->total_price_first)." VND<br>";
                                if($bill->id_coupon)
                                {
	              					$output.="
	                                Phí giảm giá: ";
	                                if($bill->coupon->number<=100)
	                                	$output.=number_format(($bill->coupon->number*$bill->total_price_first)/100);
	                                else
	                                	$output.=number_format($bill->coupon->number);
	                                $output.=" VND<br>";
	                             }
                                $output.="Phí vận chuyển: ".number_format($bill->feeship)." VND<br>
                                Thành tiền: ".number_format($bill->total_price_final)." VND<br>";
		$output.="				
		<p>Ký tên</p>
			<table>
				<thead>
					<tr>
						<th width='200px'>Người lập phiếu</th>
						<th width='800px'>Người nhận</th>
						
					</tr>
				</thead>
				<tbody>
				</tbody>
			
		</table>";

		return $output;

	}
}
