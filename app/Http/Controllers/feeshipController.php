<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\city;
use App\district;
use App\ward;
use App\feeship;
class feeshipController extends Controller
{
	public function manage()
	{
		$city=city::all();
		return view('admin.feeship.manage',['city'=>$city]);
	}
	public function choose(Request $r)
	{
		if($r->action=='city')
		{
			$output="<option value=''>--Chọn quận huyện --</option>";
			$district=district::where('id_city',$r->id)->get();
			foreach ($district as $d) {
				$output.="<option value='".$d->id."'>".$d->name."</option>";
			}

		}
		else
		{
			$output="<option value=''>--Chọn xã phường thị trấn --</option>";
			$ward=ward::where('id_district',$r->id)->get();
			 foreach ($ward as $w) {
			 	$output.="<option value='".$w->id."'>".$w->name."</option>";
			 }
		}
		 echo $output;
	}
	public function add(Request $r)
	{
		$feeship=new feeship();
		$feeship->id_city=$r->id_city;
		$feeship->id_district=$r->id_district;
		$feeship->id_ward=$r->id_ward;
		$feeship->fee=$r->fee;
		$feeship->save();
	}
	public function list()
	{
		$feeship=feeship::all();
		$output="
		 <div class='col-lg-12'>
                        <h1 class='page-header'>Phí vận chuyển
                            <small>Danh sách</small>
                        </h1>
                    </div>
		 <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                        <thead>
                            <tr align='center'>
                                <th>Số thứ tự</th>
                                <th>Tên tỉnh/thành phố </th>
                                <th>Tên quận/huyện </th>
                                <th>Tên xã/phường/thị trấn </th>
                                <th>Phí </th>
                                <th>Xóa </th>

                            </tr>
                        </thead>
                        <tbody>";
                            foreach($feeship as $f){
           			 $output.="<tr class='odd gradeX' align='center'>
                                <td>".$f->id."</td>
                                <td>".$f->city->name."</td>
                                <td>".$f->district->name."</td>
               					<td>".$f->ward->name."</td>      
                                <td contenteditable class='edit_fee_id' data-fee_id='".$f->id."'>".$f->fee."</td>
                                <td><button type='button' class='delete_fee' data-delete_fee_id='".$f->id."'>Xóa</button></td>
                            </tr>";
                            }
                            
             $output.=" </tbody>
                    	</table>";
           echo $output;
	}
	public function edit(Request $r)
	{
		$feeship=feeship::find($r->id);
		$feeship->fee=$r->fee;
		$feeship->save();

	}
	public function delete(Request $r)
	{
		$feeship=feeship::find($r->id);
		$feeship->delete();
	}
}
