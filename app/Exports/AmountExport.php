<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class AmountExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=DB::select("
            SELECT mdas.mda_name AS mda_name, SUM(projects.contract_amount) AS mda_cost, SUM(projects.amount_disbursed) AS amount_disbursed, SUM(projects.balance_payment) AS mda_balance_payment, COUNT(projects.id) AS count_project
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name
        ");

    	$result[]=['MDA','PROJECT COUNTS','TOTAL COST','AMOUNT DISBURSED','AMOUNT OUTSTANDING'];

    	foreach($datas as $key => $data){
    		$result[]=[$data->mda_name, $data->count_project, $data->mda_cost, $data->amount_disbursed, $data->mda_balance_payment];
    	}
        return collect($result);
    }
}
