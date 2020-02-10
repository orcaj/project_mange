<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class PerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $mda_id;

    public function __construct($mda_id)
    {
        $this->mda_id = $mda_id;
    }



    public function collection()
    {
    	$mda_id=$this->mda_id;
    	

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


        $result[]=['%COMPLETION','PROJECT COUNTS', 'OUTSTANDING BALANCE'];



        $result[]=['1-10', $per1[0]->per, $per1[0]->sum ];
        $result[]=['10-20', $per2[0]->per, $per2[0]->sum ];
        $result[]=['20-30', $per3[0]->per, $per3[0]->sum ];
        $result[]=['30-40', $per4[0]->per, $per4[0]->sum ];
        $result[]=['40-50', $per5[0]->per, $per5[0]->sum ];
        $result[]=['50-60', $per6[0]->per, $per6[0]->sum ];
        $result[]=['60-70', $per7[0]->per, $per7[0]->sum ];
        $result[]=['70-80', $per8[0]->per, $per8[0]->sum ];
        $result[]=['80-90', $per9[0]->per, $per9[0]->sum ];
        $result[]=['90-100', $per10[0]->per, $per10[0]->sum ];


    	

        return collect($result);
    }
}
