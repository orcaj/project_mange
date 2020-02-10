<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Mda;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'contractor',
        'mda_id',
        'zone_id',
        'lga_id',
        'contract_amount',
        'amount_disbursed',
        'balance_payment',
        'current_ipc_no',
        'current_ipc_amount',
        'project_per_completion',
        'start_date',
        'expected_date',
        'picreport_id',
        'doc_id,'
    ];

    public function mda(){
        return $this->belongsTo('App\Model\Mda');
    }

    public function lga(){
        return $this->belongsTo('App\Model\Lga');
    }

    public function zone(){
        return $this->belongsTo('App\Model\Zone');
    }

    public function pic_report(){
        return $this->hasMany('App\Model\Picreport');
    }

    
 

}
