@extends('layouts.master')

@section('content')

<style>
.card-body>.row {
    margin-top: 15px !important;
}
.col-md-2{
    display:flex;
    justify-content: flex-end;
}

.modal-body>.row {
    margin-top: 15px !important;
}

.card-footer {
    text-align: right;
}

.tab-pane {
    padding: 30px;
}

.btn-danger {
    color: white !important;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add Project</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        
                       
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Project</h3>
                        </div>
                        <div class="card-body">

                            <ul class="nav nav-fill nav-tabs flex-column flex-xl-row" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="commissions-tab" href="#project" role="tab"
                                        data-toggle="tab" aria-controls="commissions-tab">Add Project</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="payouts-tab" href="#status" data-toggle="tab" role="tab"
                                        aria-controls="payouts-tab">Status Report</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="referrals-tab" href="#pic" role="tab" data-toggle="tab"
                                        aria-controls="referrals-tab">Pictorial Report</a>
                                </li>

                            </ul>

                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="project" role="tabpanel"
                                    aria-labelledby="commissions-tab">

                                    <div class="table-responsive">
                                        @empty($project)
                                        <form role="form" action="{{route('create-project')}}" method="post">
                                            @endempty

                                            @isset($project)
                                            <form role="form" action="{{route('update-project',$project->id)}}"
                                                method="post">
                                                @method('put')
                                                @endisset
                                                @csrf

                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-2">
                                                            <label for="name">Project Name:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="text" class="form-control" name="name" required
                                                                placeholder="Project Name...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="text" class="form-control" name="name" required
                                                                placeholder="Project Name..."
                                                                value="{{$project->project_name}}">
                                                            @endisset

                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="balance">Balance Payment on Projects
                                                                (N):</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control" name="balance"
                                                                required placeholder="balance...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control" name="balance"
                                                                required placeholder="balance..."
                                                                value="{{$project->balance_payment}}">
                                                            @endisset
                                                        </div>

                                                        


                                                        

                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="balance">MDA</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="mda" id="mda" required>
                                                                @foreach($mdas as $mda)
                                                                <option value="{{$mda->id}}">{{$mda->mda_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        

                                                        <div class="col-md-2">
                                                            <label for="IPC">Current IPC:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control" name="ipc"
                                                                required placeholder="Current IPC...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control" name="ipc"
                                                                required placeholder="Current IPC..."
                                                                value="{{$project->current_ipc_no}}">
                                                            @endisset

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="id">Contractor:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="text" class="form-control" name="contractor"
                                                                required placeholder="Contractor...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="text" class="form-control" name="contractor"
                                                                required placeholder="Contractor..."
                                                                value="{{$project->contractor}}">
                                                            @endisset

                                                        </div>


                                                        <div class="col-md-2">
                                                            <label for="balance">Current IPC Amount(N):</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control" name="ipc_amount"
                                                                required placeholder="Current IPC Amount...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control" name="ipc_amount"
                                                                required placeholder="Current IPC Amount..."
                                                                value="{{$project->current_ipc_amount}}">
                                                            @endisset

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-2">
                                                            <label for="id">Senatorial Zone:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="zone_id" id="zone"
                                                                required>
                                                                @foreach($zones as $zone)
                                                                <option value="{{$zone->id}}">{{$zone->zone_name}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <label for="balance">Project % Completion:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control" name="percent"
                                                                required placeholder="Project % Completion...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control" name="percent"
                                                                required placeholder="Project % Completion..."
                                                                value="{{$project->project_per_completion}}">
                                                            @endisset

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="id">LGA/Office:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control" name="lga_id" id="lga"
                                                                required>
                                                                @foreach($lgas as $lga)
                                                                <option value="{{$lga->id}}">{{$lga->lga_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-2">
                                                            <label for="balance">Date of Award:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="date" class="form-control" name="date_award"
                                                                required placeholder="Date of Award...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="date" class="form-control" name="date_award"
                                                                required placeholder="Date of Award..."
                                                                value="{{$project->start_date}}">
                                                            @endisset

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="id">Contract Amount:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control"
                                                                name="contract_amount" required
                                                                placeholder="Contract Amount...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control"
                                                                name="contract_amount" required
                                                                placeholder="Contract Amount..."
                                                                value="{{$project->contract_amount}}">
                                                            @endisset

                                                        </div>


                                                        <div class="col-md-2">
                                                            <label for="balance">Expected end date:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="text" class="form-control" name="expected_date"
                                                                required placeholder="Expected end date...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="text" class="form-control" name="expected_date"
                                                                required placeholder="Expected end date..."
                                                                value="{{$project->expected_date}}">
                                                            @endisset

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label for="id">Amount disbursed to date:</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            @empty($project)
                                                            <input type="number" class="form-control"
                                                                name="disbursed_date" required
                                                                placeholder="Amount disbursed to date...">
                                                            @endempty

                                                            @isset($project)
                                                            <input type="number" class="form-control"
                                                                name="disbursed_date" required
                                                                placeholder="Amount disbursed to date..."
                                                                value="{{$project->amount_disbursed}}">
                                                            @endisset

                                                        </div>
                                                        
                                                    </div>



                                                </div>
                                                <!-- /.card-body -->

                                                <div class="card-footer">
                                                    @empty($project)
                                                    <button type="submit" class="btn btn-danger">Create</button>
                                                    @endempty
                                                    @isset($project)
                                                    <button type="submit" class="btn btn-danger">Update</button>
                                                    @endisset
                                                    <a href="{{route('projects')}}" class="btn btn-secondary">Go To
                                                        Projects</a>
                                                </div>
                                            </form>

                                    </div>


                                </div>

                                <div class="tab-pane fade" id="status" role="tabpanel"
                                    aria-labelledby="commissions-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn btn-danger" data-toggle="modal" data-target="#doc_report">
                                                Add Report</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">

                                        <table class="table table-striped">

                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title Of Report</th>
                                                    <th>Date Of Report</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="doc_reports">
                                                <tr>
                                                    <td colspan="4" class="text-center">No payouts yet..</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            <a href="{{route('home')}}" class="btn btn-secondary">Go To Home</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pic" role="tabpanel" aria-labelledby="commissions-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <a class="btn btn-danger" href="{{route('add-project')}}"
                                                data-toggle="modal" data-target="#pic_report">
                                                Add Report</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Title Of Report</th>
                                                    <th>Date Of Report</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="pic_reports">
                                                <tr>
                                                    <td colspan="4" class="text-center">No payouts yet..</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="card-footer">
                                            <a href="{{route('home')}}" class="btn btn-secondary">Go To Home</a>
                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        @isset($project)
        <!-- Modal Status -->
        <div class="modal fade" id="doc_report" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header align-items-center">

                        <h5 class="modal-title modal-primary">Status Report</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>X</span>
                        </button>

                    </div>

                    <form role="form" action="{{route('doc_upload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="id">Title of Report:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="status_title" required
                                       name="doc_title" placeholder="Title of Report:">
                                </div>
                                <input type="hidden" name="project_id" value="{{$project->id}}">
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <label for="id">Attachment:</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="doc_path" class="custom-file-input" id="exampleDocFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span>Close Form</span>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- Modal End -->

        <!-- Modal Picture -->
        <div class="modal fade" id="pic_report" tabindex="-1" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header align-items-center">

                        <h5 class="modal-title modal-primary">Pictoral Report</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>X</span>
                        </button>

                    </div>

                    <form role="form" action="{{route('pic_upload')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="id">Title of Report:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="pic_title" id="pic_title" required
                                        placeholder="Title of Report:">
                                    <input type="hidden" name="project_id" value="{{$project->id}}">
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <label for="id">Attachment:</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="pic_path" class="custom-file-input"
                                            id="exampleDocFile" required>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span>Close Form</span>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- Modal End -->
        @endisset
        <input type="hidden" value="{{Auth::user()->role}}" id="user_role">
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@isset($project)
<script>
$(document).ready(function() {
    set_select();

    fetch_report();

    user_role= $("#user_role").val();

    function set_select() {
        mda_id = <?php echo $project->mda_id ?> ;
        zone_id = <?php echo $project->zone_id ?> ;
        lga_id = <?php echo $project->lga_id ?> ;
        $("#mda").val(mda_id);
        $("#zone").val(zone_id);
        $("#lga").val(lga_id);
    }

    function fetch_report(){
        project_id = <?php echo $project->id ?> ;
        $.ajax({
            url: "{{route('fetch_reports')}}",
            method: "post",
            data: {
                _token: "{{csrf_token()}}",
                project_id: project_id,
            },
            dataType: 'json',
            success: function(result) {
                console.log(result.doc_reports);
                pic_body="";
                pic_reports=result.pic_reports;
                $.each(pic_reports, function(i){
                    pic_body+="<tr><td>"+(i+1)+"</td>";
                    pic_body+="<td>"+pic_reports[i].title+"</td>";
                    pic_body+="<td>"+pic_reports[i].updated_at+"</td>";
                    if(user_role == 'admin'){
                        pic_body+="<td>"+"<a class='btn btn-danger' href='pic_download/"+pic_reports[i].id +"'>Download</a>"+"</td></tr>";
                    }else{
                        pic_body+="<td></td></tr>"
                    }
                })
                if(pic_body!=""){
                    $("#pic_reports").html(pic_body);
                }

                doc_body="";
                doc_reports=result.doc_reports;
                $.each(doc_reports, function(i){
                    doc_body+="<tr><td>"+(i+1)+"</td>";
                    doc_body+="<td>"+doc_reports[i].title+"</td>";
                    doc_body+="<td>"+doc_reports[i].updated_at+"</td>";
                    if(user_role == 'admin'){
                        doc_body+="<td>"+"<a class='btn btn-danger' href='/doc_download/"+doc_reports[i].id +"'>Download</a>"+"</td></tr>";
                    }else{
                        doc_body+="<td></td></tr>"
                    }
                })
                if(doc_body!=""){
                    $("#doc_reports").html(doc_body);
                }
            },
            error: function(e){
                console.log(e);
            }
        })

    }





})
</script>
@endif


@section('javascript')
<!-- jQuery -->
<script src="{{asset('/dist/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('/dist/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('/dist/js/demo.js')}}"></script>
<script src="{{asset('/dist/js/pages/dashboard3.js')}}"></script>
@stop




@endsection