<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Mda;

class MDAManageController extends Controller
{
    public function index(){
        $mdas=Mda::paginate(10);
        return view('admin.MDA', compact('mdas'));
    }

    public function mdaCreate(Request $request){
        $mda= new Mda();
        $mda->mda_name=$request->mda_name;
        $mda->short_name=$request->short_name;
        $mda->save();
        return redirect('MDA-manage');
    }

    public function mdaDelete($id){
        $mda= Mda::destroy($id);
        return redirect('MDA-manage');
    }

    public function mdaUpdate(Request $request){
        $id=$request->id;
        $mda= Mda::FindOrFail($id);
        $mda->mda_name=$request->mda_name;
        $mda->short_name=$request->short_name;
        $mda->save();
        return redirect('MDA-manage');
    }
}
