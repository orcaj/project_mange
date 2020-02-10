@extends('layouts.master')

@section('content')
<style>
tr>td, tr>th{
    text-align: center;
}
.left-text{
    text-align: left;
}

</style>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">LGA VS PROJECT COUNTS</h1>
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
                <div class="col-lg-6">
                    <div class="card card-primary" id="main">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="card-title col-10">LGA vs Project COUNTS</h3>
                                <a class="btn btn-danger col-2" id="export">Export</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <table class="table table-striped table-valign-middle"  rules="all">
                                    <thead>
                                        <tr>
                                            <th>LGA</th>
                                            <th>PROJECT COUNTS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $key=>$data)
                                        <tr>
                                            <td class="left-text">
                                                {{$data->lga}}
                                            </td>
                                            <td>{{$data->count_project}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            
                <div class="col-6">
                    <div class="card rounded">
                        <div class="card-body py-3 px-3"   id="chart_div">
                        </div>
                    </div>
              
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    function export_excel() {
        document.location.href="{!! route('fetch_countexport','lga'); !!}";
    }
    
    
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#export").on('click',function(){
            export_excel();
        })

        height_main=$("#main").height();
        console.log("height_main",height_main);
        $.ajax({
            url: "{{route('fetch_lgadata')}}",
            method: "post",
            data: {
                _token: "{{csrf_token()}}",
            },
            dataType: 'json',
            success: function(result) {
                console.log('result',result);



                google.charts.load('current', {
                    packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawTitleSubtitle);

                chart_data=[['% percent', 'OUTSTANDING BALANCE', { role: 'style' }]];

                for (var i = 0; i < result.length; i++) {
                    chart_data.push([result[i].label, parseInt(result[i].value), '']);
                }

                console.log("chart_data",chart_data);

                function drawTitleSubtitle() {
                    var data = google.visualization.arrayToDataTable(
                         chart_data,
                    );
                    console.log("data", data)

                    var options = {
                        height: height_main-30,
                        animation:{
                            duration: 1000,
                            easing: 'out',
                        },
                        chart: {
                            title: 'Motivation and Energy Level Throughout the Day',
                            subtitle: 'Based on a scale of 1 to 10'
                        },
                        chartArea: {height: '100%'},
                        hAxis: {
                            title: 'Time of Day',
                            
                        },
                        vAxis: {
                            title: 'Rating (scale of 1-10)'
                        }
                    };

                    var materialChart = new google.visualization.BarChart(document.getElementById('chart_div'));
                    materialChart.draw(data, options);
                }

            },
            error: function(e) {
                console.log(e);
            }
        })
    
    })

</script>
<!-- /.content-wrapper -->
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