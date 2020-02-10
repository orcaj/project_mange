<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Charts\UserChart;
use App\Model\Mda;

class CountCostController extends Controller
{
    public function index(){
        $datas=DB::select(
            "SELECT mdas.mda_name as mda_name ,COUNT(projects.id) as mda_count, SUM(projects.contract_amount) as mda_sum
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name"
            );

        $label=[];
        $value=[];
        foreach($datas as $key => $data){
		  // $label[] = $key+1;
		  $short_name = Mda::where('mda_name',$data->mda_name)->get('short_name');
		  $label[] =$short_name[0]->short_name;
		  $value[]=$data->mda_sum;
		}

	    $usersChart = new UserChart;
	    // $usersChart->labels(['Jan', 'Feb', 'Mar']);
	    // $usersChart->dataset('Users by trimester', 'bar', [10, 25, 13])
	    //         ->color("blue")
	    //         ->backgroundcolor("#6cb2eb");

        $usersChart->labels($label);
	    $usersChart->dataset('Count VS Cost', 'bar', $value)
	            ->color("blue")
	            ->backgroundcolor("#6cb2eb")
	            ->fill(false)
            ->linetension(0.1)
            ->dashed([5]);

	    return view('common.count-cost',compact('datas','usersChart'));
    }

    
}
