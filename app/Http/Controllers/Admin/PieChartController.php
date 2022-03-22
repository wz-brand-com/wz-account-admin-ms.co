<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PieChartController extends Controller
{
    public function index()
    {
      
    $result = DB::select(DB::raw("select count(*) as total_u_org_role_name, u_org_role_name from usersorganizations group by u_org_role_name
    "));
      $chartData="";
      foreach($result as $list){
          $chartData.="['".$list->u_org_role_name."', ".$list->total_u_org_role_name."],";
      }
      $arry['chartDatas']=rtrim($chartData,",");
     
        return view('admin/chart',$arry);
    }
}
