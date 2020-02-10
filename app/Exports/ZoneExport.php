<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Facades\DB;

class ZoneExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $datas=DB::select("
            SELECT zones.zone_name AS zone, COUNT(projects.id) AS count_project
                FROM zones
                LEFT JOIN projects ON zones.id=projects.zone_id
                GROUP BY zone
            ");

    	$result[]=['Senatorial Zone','PROJECT COUNTS'];

    	foreach($datas as $key => $data){
    		$result[]=[$data->zone, $data->count_project];
    	}
        return collect($result);
    }
}
