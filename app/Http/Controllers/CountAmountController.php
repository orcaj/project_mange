<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Mda;
use App\Charts\UserChart;


class CountAmountController extends Controller
{
    public function index(){
        $datas=DB::select("
            SELECT mdas.mda_name AS mda_name, SUM(projects.contract_amount) AS mda_cost, SUM(projects.amount_disbursed) AS amount_disbursed, SUM(projects.balance_payment) AS mda_balance_payment, COUNT(projects.id) AS count_project
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name
        ");

    	$label=[];
        $value=[];
        foreach($datas as $key => $data){
		  // $label[] = $key+1;
		  $short_name = Mda::where('mda_name',$data->mda_name)->get('short_name');
		  $label[] =$short_name[0]->short_name;
		  $value[]=$data->amount_disbursed;
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

        return view('common.count-cost-amount', compact('datas','usersChart'));
    }
}