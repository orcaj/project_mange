<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Mda;
use App\Model\Project;
use App\Model\Lga;
use App\Model\Zone;

use App\Charts\UserChart;
use App\Exports\PerExport;
use Maatwebsite\Excel\Facades\Excel;

class TableController extends Controller
{
    public function index(){
        $datas=DB::select(
            "SELECT mdas.mda_name as mda_name ,COUNT(projects.id) as mda_count, SUM(projects.balance_payment) AS mda_balance_payment
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name"
            );

        $mdas=Mda::all();
        $mda_id=$mdas[0]['id'];


        return view('common.table', compact('mdas'));
    }


    public function fetch_perdata(Request $request){
        $mda_id=$request->mda_id;
        
        $statistics=DB::select("
            SELECT COUNT(projects.id) AS mda_count, SUM(projects.balance_payment) AS mda_balance_payment
            FROM mdas
            LEFT JOIN projects ON mdas.id=projects.mda_id
            WHERE mdas.id = :id",['id' => $mda_id]);

        $per1=DB::select("
            select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 0 and 10 and mdas.id= :id", ['id' => $mda_id]);

        $per2=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 10 and 20 and mdas.id= :id", ['id' => $mda_id]);
        
        $per3=DB::select("
            select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 20 and 30 and mdas.id= :id", ['id' => $mda_id]);

        $per4=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 30 and 40 and mdas.id= :id", ['id' => $mda_id]);

        $per5=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 40 and 50 and mdas.id= :id", ['id' => $mda_id]);

        $per6=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 50 and 60 and mdas.id= :id", ['id' => $mda_id]);

        $per7=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 60 and 70 and mdas.id= :id", ['id' => $mda_id]);

        $per8=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 70 and 80 and mdas.id= :id", ['id' => $mda_id]);

        $per9=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 80 and 90 and mdas.id= :id", ['id' => $mda_id]);

        $per10=DB::select("select count(projects.id) as per, SUM(balance_payment) as sum
            from projects
            left join mdas on mdas.id=projects.mda_id
            where project_per_completion between 90 and 100 and mdas.id= :id", ['id' => $mda_id]);

        $label=['0-10','10-20','20-30','30-40','40-50','50-60','60-70','70-80','80-90','90-100'];
        $value=[$per1, $per2, $per3, $per4, $per5, $per6, $per7, $per8, $per9, $per10];
        


        $result=array(
            'sum'=> $statistics,
            'per1' => $per1,
            'per2' => $per2,
            'per3' => $per3,
            'per4' => $per4,
            'per5' => $per5,
            'per6' => $per6,
            'per7' => $per7,
            'per8' => $per8,
            'per9' => $per9,
            'per10' => $per10,
            // 'usersChart' => $usersChart,
            // 'chart' => $chart,
        );




        return $result;
    }

    public function lga_count(){
        $datas=DB::select("
            SELECT lgas.lga_name AS lga, COUNT(projects.id) AS count_project
                FROM lgas
                LEFT JOIN projects ON lgas.id=projects.lga_id
                GROUP BY lgas.lga_name
            ");


        $label=[];
        $value=[];
        foreach($datas as $key => $data){
          // $label[] = $key+1;
          $short_name = Lga::where('lga_name',$data->lga)->get('short_name');
          $label[] =$short_name[0]->short_name;
          $value[]=$data->count_project;
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

        return view('common.lga_count', compact('datas','usersChart'));
    }

    public function fetchLgadata(Request $request){


        $datas=DB::select("
            SELECT lgas.lga_name AS lga, COUNT(projects.id) AS count_project
                FROM lgas
                LEFT JOIN projects ON lgas.id=projects.lga_id
                GROUP BY lgas.lga_name
            ");

        $label=[];
        $value=[];
        foreach($datas as $key => $data){
          // $label[] = $key+1;
          $short_name = Lga::where('lga_name',$data->lga)->get('short_name');
          $result[]=array(
            "label" => $short_name[0]->short_name,
            "value" => $data->count_project,
          );
         
        }
        return json_encode($result);
    }

    public function zone_count(){
        $datas=DB::select("
            SELECT zones.zone_name AS zone, COUNT(projects.id) AS count_project
                FROM zones
                LEFT JOIN projects ON zones.id=projects.zone_id
                GROUP BY zone
            ");

        $label=[];
        $value=[];
        foreach($datas as $key => $data){
          // $label[] = $key+1;
          $short_name = Zone::where('zone_name',$data->zone)->get('short_name');
          $label[] =$short_name[0]->short_name;
          $value[]=$data->count_project;
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

        return view('common.zone_count',compact('datas','usersChart'));

    }

    public function fetchZonedata(Request $request){


        $datas=DB::select("
            SELECT zones.zone_name AS zone, COUNT(projects.id) AS count_project
                FROM zones
                LEFT JOIN projects ON zones.id=projects.zone_id
                GROUP BY zone
            ");

        $label=[];
        $value=[];
        foreach($datas as $key => $data){
          // $label[] = $key+1;
          $short_name = Zone::where('zone_name',$data->zone)->get('short_name');
          $result[]=array(
            "label" => $short_name[0]->short_name,
            "value" => $data->count_project,
          );
         
        }
        return json_encode($result);
    }

    public function fetchPerexport($mda_id){

        $export=new PerExport($mda_id);
        $file_name='%COMPLETION VS PROJECT COUNT VS OUTSTANDING.xlsx';

        return Excel::download($export, $file_name);
    }


}
