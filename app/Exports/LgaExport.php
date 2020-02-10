<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class LgaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=DB::select("
            SELECT lgas.lga_name AS lga, COUNT(projects.id) AS count_project
                FROM lgas
                LEFT JOIN projects ON lgas.id=projects.lga_id
                GROUP BY lgas.lga_name
            ");

    	$result[]=['LGA','PROJECT COUNTS'];

    	foreach($datas as $key => $data){
    		$result[]=[$data->lga, $data->count_project];
    	}
        return collect($result);
    }
}
