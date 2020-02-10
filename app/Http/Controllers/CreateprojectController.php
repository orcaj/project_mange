<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Model\Mda;
use App\Model\Lga;
use App\Model\Zone;
use App\Model\Picreport;
use App\Model\Doc;

class CreateprojectController extends Controller
{
    public function index(){
        $mdas=Mda::all();
        $zones=Zone::all();
        $lgas=Lga::all();

        return view('common.add-project', compact('mdas','zones','lgas'));
    }

    public function picUpload(Request $request){
        $request->validate([
            'pic_title' => 'required',
            'pic_path' => 'required|image'
        ]);

        $pic = $request->file('pic_path');

        $path = $pic->store('public/files');

        $title=$request->title;
        $title=$title.$pic->getClientOriginalName();

        $pic_data=array(
            'project_id' => $request->project_id,
            'title' => $title,
            'pic_path' => $path,
        );

        Picreport::create($pic_data);

        return redirect()->route('home');
    }


    public function docUpload(Request $request){
        $request->validate([
            'doc_title' => 'required',
            'doc_path' => 'required'
        ]);

        $doc = $request->file('doc_path');

        $path = $doc->store('public/files');

        $title=$request->pic_path;
        $title=$title.$doc->getClientOriginalName();

        $doc_data=array(
            'project_id' => $request->project_id,
            'title' => $title,
            'doc_path' => $path,
        );

        Doc::create($doc_data);

        return redirect()->route('home');
    }

    public function fetchReports(Request $request){
        $project_id=$request->project_id;
        $pic_reports=Picreport::where('project_id',$project_id)->get();

        $doc_reports=Doc::where('project_id',$project_id)->get();

        $result=array(
            'pic_reports' => $pic_reports,
            'doc_reports' => $doc_reports,
        );

        return json_encode($result);
    }

    public function picDownload($pic_id){
        $pic=Picreport::find($pic_id);

        return Storage::download($pic->pic_path, $pic->title);
    }

    public function docDownload($doc_id){
        $doc=Doc::find($doc_id);
        return Storage::download($doc->doc_path, $doc->title);
    }
}
