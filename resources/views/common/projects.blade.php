@extends('layouts.master')

@section('content')
<style>
.home-control {
    display: flex;
    justify-content: flex-end;
}
.card{
    overflow:auto;
}
.big-red{
    font-size: 18px;
    color: red;
}

tr>th, tr>td {
  text-align: center; /* For Edge */
  -moz-text-align-last: center; /* For Firefox prior 58.0 */
  margin:auto;
}

tr>th{
    background-color: gold;
}



.font-eng{
    font-family: "Times New Roman";
}
.font-eng>th{
    font-weight: bold;
    font-size:14px;
}

tbody{
    font-size: 12px;
}

/*misc*/

.flex-center{
    display: flex;
    justify-content: flex-end;
}

#wrap table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}

.large-table-container-2 {
  overflow-x: scroll;
  overflow-y: auto;
  transform:rotateX(180deg);
}
.large-table-container-2 table {
  transform:rotateX(180deg);
}

#wrap {
    overflow: auto;
    height: 930px;
}

.wrapper1, .wrapper2 { width: 100%; overflow-x: scroll; overflow-y: hidden; }
.wrapper1 { height: 20px; }
.wrapper2 {}
.div1 { height: 20px; }
.div2 { overflow: none; }



/* Just common table stuff. Really. */

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11">
                    <h1 class="m-0 text-dark"><span style="color: ">Projects</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-1">
                    <a class="btn btn-danger" href="{{route('add-project')}}">Add Project</a>
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
                            <h3 class="card-title">Action</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">


                                <div class="col-2 home-control">
                                    <label class="common-font-size">Total Projects</label>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" value="{{$projects->count}}" disabled>
                                </div>
                                
                                <div class="col-1 home-control">
                                    <label class="common-font-size">MDA</label>
                                </div>
                                <div class="col-2">
                               
                                    <select class="form-control" id='mda'>
                                        <option value="">all</option>
                                        @foreach($mdas as $mda)
                                        <option value="{{$mda->id}}">{{$mda->mda_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2 home-control">
                                    <label class="common-font-size">Senatorial Zone</label>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" id='zone'>
                                        <option value="">all</option>
                                        @foreach($zones as $zone)
                                        <option value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-1 home-control">
                                    <label class="common-font-size">L.G.A</label>
                                </div>
                                <div class="col-1">
                                    <select class="form-control" id='lga'>
                                        <option value="">all</option>

                                        @foreach($lgas as $lga)
                                        <option value="{{$lga->id}}">{{$lga->lga_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1">
                                    
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-lg-12">
                    <!-- /.card -->

                    

                    <div class="card">
                        <div class="card-header no-border">
                            <div class="row">
                                <!-- <h3 class="card-title col-1">Projects</h3> -->


                                <div class=" col-2">
                                    <label class="flex-center common-font-size" >Total Contract Amount (N)</label>
                                </div>
                                <div class=" col-2">
                                    <input type="text" class="form-control" value="{{ number_format($projects->sum, 2, '.', ',')}}" disabled>
                                </div>

                                <div class=" col-2">
                                    <label class="flex-center common-font-size">Total Amount Disbursed (N)</label>
                                </div>
                                <div class=" col-2">
                                    <input type="text" class="form-control" value="{{ number_format($projects->sum_disbursed, 2, '.', ',')}}" disabled>
                                </div>

                                <div class=" col-2">
                                    <label class="flex-center common-font-size">Total Balance payments on projects (N)</label>
                                </div>
                                <div class=" col-2">
                                    <input type="text" class="form-control" value="{{ number_format($projects->sum_balance, 2, '.', ',')}}" disabled>
                                </div>

                            </div>


                          
                        </div>
                        <div class="wrapper1">
                            <div class="div1"></div>
                        </div>

                        <div class="wrapper2" id="wrap">
                            <div class="div2">
                            <table class="table table-striped table-valign-middle font-eng"  rules="all">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        
                                        <th>Project Name</th>
                                        <th>MDA</th>
                                        <th>Contractor</th>
                                        <th>Senatorial Zone</th>
                                        <th>LGA/Office</th>
                                        <th>Contract Amount(N)</th>
                                        <th>Amount disbursed(N)</th>
                                        <th>Balance Payment on Projects(N)</th>
                                        <th>Current IPC</th>
                                        <th>Current IPC Amount(N)</th>
                                        <th>Project % Cc</th>
                                        <th>Date of Award</th>
                                        <th>Expected end date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $key=>$project)
                                    <tr onclick="edit_project('{{route('edit_project', $project->id)}}')">
                                        <td>
                                            {{$key+1}}
                                        </td>
                                        

                                        <td>{{$project->project_name}}</td>
                                        <td>{{$project->mda->mda_name}}</td>
                                        <td>{{$project->contractor}}</td>
                                        @if($project->zone)
                                        <td>{{$project->zone->zone_name}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                         @if($project->lga)
                                        <td>{{$project->lga->lga_name}}</td>
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{ number_format($project->contract_amount, 2, '.', ',') }}</td>
                                        <td>{{ number_format($project->amount_disbursed, 2, '.', ',') }}</td>
                                        <td>{{ number_format($project->balance_payment, 2, '.', ',') }}</td>
                                        <td>{{ $project->current_ipc_no }}</td>
                                        <td>{{ number_format($project->current_ipc_amount, 2, '.', ',') }}</td>
                                        <td>{{$project->project_per_completion}}</td>
                                        <td>{{$project->start_date}}</td>
                                        <td>{{$project->expected_date}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan='6'></td>
                                        <td class="big-red"><b>{{ number_format($projects->sum, 2,'.', ',') }}</b></td>
                                        <td class="big-red"><b>{{ number_format($projects->sum_disbursed, 2, '.', ',') }}</b></td>
                                        <td class="big-red"><b>{{ number_format($projects->sum_balance, 2,'.', ',') }}</b></td>
                                        <td colspan='5'></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>

                        </div>

                    </div>
                </div>


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@isset($mda_id)
<input type="hidden" id="mda_id" value="{{$mda_id}}">


<script type="text/javascript">
    $(document).ready(function(){
        mda_id=$("#mda_id").val();
        console.log(mda_id);
        $("#mda").val(mda_id);
    })
    


</script>
@endisset

<script>
    //head fixed
document.getElementById("wrap").addEventListener("scroll", function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
});

function edit_project(url) {
    console.log(url);
    document.location.href = url;
}

</script>

<script>
    // top scroll
$(window).on('load', function (e) {
    $('.div1').width($('table').width());
    $('.div2').width($('table').width());
});

$(document).ready(function() {
   // top scroll
    $('.wrapper1').on('scroll', function (e) {
        $('.wrapper2').scrollLeft($('.wrapper1').scrollLeft());
    }); 
    $('.wrapper2').on('scroll', function (e) {
        $('.wrapper1').scrollLeft($('.wrapper2').scrollLeft());
    });


 

    status_change();

    function status_change() {
        $('#mda').change(function() {
            fetch_projects();
        });
        $('#lga').change(function() {
            fetch_projects();
        });
        $('#zone').change(function() {
            fetch_projects();
        });
    }
    
    function currencyFormat(num) {
      num=parseFloat(num);
      return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }



    function fetch_projects() {
        mda = $("#mda").val();
        lga_id = $("#lga").val();
        zone_id = $("#zone").val();
        $.ajax({
            url: "{{route('fetch_projects')}}",
            method: "post",
            data: {
                _token: "{{csrf_token()}}",
                mda: mda,
                lga_id: lga_id,
                zone_id: zone_id,
            },
            dataType: 'json',
            success: function(result) {
                tbody = "";
                console.log(result);
                projects = result.projects;
                if (projects.length != 0) {
                    $.each(projects, function(i) {
                        tbody +=
                            `<tr onclick="edit_project('{{url('edit_project/` + projects[i].id+`')}}')">`;
                        tbody += "<td>" + (i + 1) + "</td>";
                       
                        tbody += "<td>" + (projects[i].project_name) + "</td>";
                         tbody += "<td>" + (projects[i].mda.mda_name) + "</td>";
                        tbody += "<td>" + (projects[i].contractor) + "</td>";
                        if(projects[i].zone){
                            tbody += "<td>" + (projects[i].zone.zone_name) + "</td>";
                        }else{
                            tbody += "<td></td>";
                        }
                        
                        if(projects[i].lga){
                            tbody += "<td>" + (projects[i].lga.lga_name) + "</td>";
                        }else{
                            tbody += "<td></td>";
                        }
                        
                        
                        tbody += "<td>" + currencyFormat(projects[i].contract_amount) + "</td>";
                        tbody += "<td>" + currencyFormat(projects[i].amount_disbursed) + "</td>";
                        tbody += "<td>" + currencyFormat(projects[i].balance_payment) + "</td>";
                        tbody += "<td>" + (projects[i].current_ipc_no) + "</td>";
                        tbody += "<td>" + currencyFormat(projects[i].current_ipc_amount) + "</td>";
                        tbody += "<td>" + (projects[i].project_per_completion) + "</td>";
                        tbody += "<td>" + (projects[i].start_date) + "</td>";
                        tbody += "<td>" + (projects[i].expected_date) + "</td></tr>";
                        
                    });
                } else {
                    tbody = "";
                }
                if (tbody == "") {
                    tbody =
                        "<tr class='alert alert-secondary text-center'><td colspan='14'><h4>There is no data.</h4></td></tr>"
                } else {
                    tbody += "<tr><td colspan='6'></td>";
                    tbody += "<td class='big-red'><b>" + currencyFormat(result.sum) + "</b></td>";
                    tbody += "<td class='big-red'><b>" + currencyFormat(result.sum_disbursed) + "</b></td>";
                    tbody += "<td class='big-red'><b>" + currencyFormat(result.sum_balance) + "</b></td>";
                    tbody += "<td colspan='5'></td></tr>";
                }
                $("tbody").html(tbody);


            },
            error: function(e) {
                console.log(e);
            }
        })
    }


})
</script>
@endsection

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