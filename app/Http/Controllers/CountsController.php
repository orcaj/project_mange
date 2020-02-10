<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Model\Mda;
use App\Charts\UserChart;


use App\Exports\CountExport;
use App\Exports\AmountExport;
use App\Exports\CostExport;
use App\Exports\LgaExport;
use App\Exports\PerExport;
use App\Exports\ZoneExport;
use Maatwebsite\Excel\Facades\Excel;


class CountsController extends Controller
{
    public function index(){
        $datas=DB::select(
            "SELECT mdas.mda_name as mda_name ,COUNT(projects.id) as mda_count
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
		  $value[]=$data->mda_count;
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

        return view('common.counts', compact('datas','usersChart'));
    }

    public function fetchCountdata(Request $request){


    	$datas=DB::select(
            "SELECT mdas.mda_name as mda_name ,COUNT(projects.id) as mda_count
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name"
            );

    	$label=[];
        $value=[];
        foreach($datas as $key => $data){
		  // $label[] = $key+1;
		  $short_name = Mda::where('mda_name',$data->mda_name)->get('short_name');
		  $result[]=array(
		  	"label" => $short_name[0]->short_name,
		  	"value" => $data->mda_count,
		  );
		  $label[] =$short_name[0]->short_name;
		  $value[]=$data->mda_count;
		}


		return json_encode($result);

    }

    public function fetchCountexport($state){
    	switch ($state) {
    		case 'count':
    			$export=new CountExport();
    			$file_name='Project Count.xlsx';
    			break;

    		case 'amount':
    			$export=new AmountExport();
    			$file_name='Project Count vs Cost vs Amount Disbursed.xlsx';
    			break;

    		case 'cost':
    			$export=new CostExport();
    			$file_name='Project Count vs Cost.xlsx';
    			break;

    		case 'lga':
    			$export=new LgaExport();
    			$file_name='LGA vs Project Count.xlsx';
    			break;

    		case 'zone':
    			$export=new ZoneExport();
    			$file_name='Senatorial Zone vs Project Count.xlsx';
    			break;

    		case 'per':
    			$export=new PerExport();
    			$file_name='%COMPLETION VS PROJECT COUNT VS OUTSTANDING BALANCE.xlsx';
    			break;
    		
    		
    		default:
    			return redirect()->back();
    			break;
    	}

    	
	  	return Excel::download($export, $file_name);
    }
}
