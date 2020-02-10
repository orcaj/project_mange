<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LGAController extends Controller
{
    public function index(){
        $datas=DB::select("
        SELECT mdas.mda_name, COUNT(projects.id) AS mda_count, COUNT(projects.zone_id) AS senatorial_zone,COUNT(projects.lga_id) AS location
        FROM mdas
        LEFT JOIN projects ON projects.mda_id=mdas.id
        GROUP BY mdas.mda_name
            ");
        return view('common.LGA-zone', compact('datas'));
    }
}