<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Project;
use App\Model\Mda;
use App\Model\Zone;
use App\Model\Lga;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $projects=Project::all();
        $count=Project::all()->count();
        $sum=Project::all()->sum('contract_amount');
        $sum_disbursed=Project::all()->sum('amount_disbursed');
        $sum_balance=Project::all()->sum('balance_payment');
        // $projects->count=$count;
        // $projects->sum=$sum;
        // $projects->sum_disbursed=$sum_disbursed;
        // $projects->sum_balance=$sum_balance;

        // $lgas=Lga::all();
        // $zones=Zone::all();
        $mdas=Mda::all();

        return view('home',compact('count','sum','sum_disbursed','sum_balance', 'mdas') );
    }

    public function projects(){
        $projects=Project::all();
        $count=Project::all()->count();
        $sum=Project::all()->sum('contract_amount');
        $sum_disbursed=Project::all()->sum('amount_disbursed');
        $sum_balance=Project::all()->sum('balance_payment');
        $projects->count=$count;
        $projects->sum=$sum;
        $projects->sum_disbursed=$sum_disbursed;
        $projects->sum_balance=$sum_balance;

        $lgas=Lga::all();
        $zones=Zone::all();
        $mdas=Mda::all();

        return view('common.projects',compact('projects','zones','lgas', 'mdas') );
    }

    public function mda_info($mda_id){

        $projects=Project::where('mda_id', $mda_id)->get();


        $count=Project::all()->count();
        $sum=Project::all()->sum('contract_amount');
        $sum_disbursed=Project::all()->sum('amount_disbursed');
        $sum_balance=Project::all()->sum('balance_payment');
        $projects->count=$count;
        $projects->sum=$sum;
        $projects->sum_disbursed=$sum_disbursed;
        $projects->sum_balance=$sum_balance;


        $lgas=Lga::all();
        $zones=Zone::all();
        $mdas=Mda::all();

        return view('common.projects',compact('projects','zones','lgas', 'mdas','mda_id') );
    }


    function getMdas(Request $request){
        $mdas=Mda::all();
        return json_encode($mdas);
    }

    public function globalSearch(Request $request){
        $search=$request->keyword;
        $projects=Project::where('project_name', 'LIKE', '%'.$search.'%')
            ->orWhere('contractor', 'LIKE', '%'.$search.'%')
            ->orWhereHas('mda', function($q) use($search) {
                    $q->where('mda_name', 'like', '%'.$search.'%');
                })
            ->get();

        $count=Project::all()->count();
        $sum=Project::all()->sum('contract_amount');
        $sum_disbursed=Project::all()->sum('amount_disbursed');
        $sum_balance=Project::all()->sum('balance_payment');
        $projects->count=$count;
        $projects->sum=$sum;
        $projects->sum_disbursed=$sum_disbursed;
        $projects->sum_balance=$sum_balance;


        $lgas=Lga::all();
        $zones=Zone::all();
        $mdas=Mda::all();

        return view('common.projects',compact('projects','zones','lgas', 'mdas') );
    }

    public function createProject(Request $request){
        $project=new Project();
        $project->project_name=$request->name;
        $project->contractor=$request->contractor;
        $project->mda_id=$request->mda;
        $project->zone_id=$request->zone_id;
        $project->lga_id=$request->lga_id;
        $project->contract_amount=$request->contract_amount;
        $project->amount_disbursed=$request->disbursed_date;
        $project->balance_payment=$request->balance;
        $project->current_ipc_no=$request->ipc;
        $project->current_ipc_amount=$request->ipc_amount;
        $project->project_per_completion=$request->percent;
        $project->start_date=$request->date_award;
        $project->expected_date=$request->expected_date;
        $project->save();
        return redirect()->route('home');
    }

    public function fetchProject(Request $request){
        $mda_id=$request->mda;
        $lga_id=$request->lga_id;
        $zone_id=$request->zone_id;
        // if($mda_id){
        //     $projects=Project::where('mda_id',$mda_id)
        //     ->with('mda')
        //     ->with('lga')
        //     ->with('zone')
        //     ->get();
        //     $sum=Project::where('mda_id',$mda_id)->sum('contract_amount');
        //     $sum_disbursed=Project::where('mda_id',$mda_id)->sum('amount_disbursed');
        //     $sum_balance=Project::where('mda_id',$mda_id)->sum('balance_payment');
        // }
        if($mda_id && $lga_id && $zone_id){
            $query = ['zone_id' => $zone_id, 'lga_id' => $lga_id, 'mda_id' => $mda_id];
        }
        if(!$mda_id && $lga_id && $zone_id){
            $query = ['zone_id' => $zone_id, 'lga_id' => $lga_id];
        }
        if($mda_id && !$lga_id && $zone_id){
            $query = ['zone_id' => $zone_id, 'mda_id' => $mda_id];
        }
        if($mda_id && $lga_id && !$zone_id){
            $query = ['lga_id' => $lga_id, 'mda_id' => $mda_id];
        }
        if($mda_id && !$lga_id && !$zone_id){
            $query = ['mda_id' => $mda_id];
        }
        if(!$mda_id && $lga_id && !$zone_id){
            $query = ['lga_id' => $lga_id];
        }
        if(!$mda_id && !$lga_id && $zone_id){
            $query = ['zone_id' => $zone_id];
        }
        
        if(!$mda_id && !$lga_id && !$zone_id){
            $projects=Project::with('mda')->with('lga')->with('zone')->get();
            $sum=Project::all()->sum('contract_amount');
            $sum_disbursed=Project::all()->sum('amount_disbursed');
            $sum_balance=Project::all()->sum('balance_payment');
        }else{
            $projects=Project::with('mda')->with('lga')->with('zone')
            ->where($query)
            ->get();
            $sum=Project::where($query)->sum('contract_amount');
            $sum_disbursed=Project::where($query)->sum('amount_disbursed');
            $sum_balance=Project::where($query)->sum('balance_payment');
        }

        $result = array(
            'projects' => $projects,
            'sum' => $sum,
            'sum_disbursed' => $sum_disbursed,
            'sum_balance' => $sum_balance,
        );
        
        return json_encode($result);
    }

    public function editProject(Request $request, $id){
        $project=Project::FindOrFail($id);

        $lgas=Lga::all();
        $zones=Zone::all();
        $mdas=Mda::all();

        return view('common.add-project',compact('project','lgas','zones','mdas'));
    }

    public function updateProject(Request $request, $id){
        $project=Project::FindOrFail($id);
        $project->project_name=$request->name;
        $project->contractor=$request->contractor;
        $project->mda_id=$request->mda;
        $project->zone_id=$request->zone_id;
        $project->lga_id=$request->lga_id;
        $project->contract_amount=$request->contract_amount;
        $project->amount_disbursed=$request->disbursed_date;
        $project->balance_payment=$request->balance;
        $project->current_ipc_no=$request->ipc;
        $project->current_ipc_amount=$request->ipc_amount;
        $project->project_per_completion=$request->percent;
        $project->start_date=$request->date_award;
        $project->expected_date=$request->expected_date;
        $project->save();
        return redirect()->route('home');
    }
}
