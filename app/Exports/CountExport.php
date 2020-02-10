<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class CountExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	$datas=DB::select(
            "SELECT mdas.mda_name as mda_name ,COUNT(projects.id) as mda_count
            FROM mdas
            LEFT JOIN projects ON projects.mda_id=mdas.id
            GROUP BY mdas.mda_name"
            );

    	$result[]=['MDA','PROJECT COUNTS'];

    	foreach($datas as $key => $data){
    		$result[]=[$data->mda_name, $data->mda_count];
    	}
        return collect($result);
    }
}
