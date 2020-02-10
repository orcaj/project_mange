@extends('layouts.master')

@section('content')

<style>
.card-body>.row {
    display: flex;
}

.col-md-1 {
    display: flex;
    justify-content: center;
}
tr>td, tr>th{
    text-align: center;
}
</style>
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">% COMPLETION, PROJECT COUNT, OUTSTANDING BALANCE</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v3</li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row" id="main">
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <h3 class="card-title col-10">TABLE</h3>
                                <a class="btn btn-danger col-2" id="export">Export</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <label for="mda">MDA</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="mda_id" id="mda" class="form-control">
                                        @foreach($mdas as $mda)
                                        <option value="{{$mda->id}}">{{$mda->mda_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <table class="table table-striped table-valign-middle"  rules="all">
                                <thead>
                                    <tr>
                                        <th>%COMPLETION</th>
                                        <th>PROJECT COUNT</th>
                                        <th>OUTSTANDING BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            
                <div class="col-6">
                    <div class="card rounded">
                        <div class="card-body py-3 px-3" id="chart_div">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    


</div>
<script>
$(document).ready(function() {

    $("#export").on('click',function(){
        export_excel();
    })
    

    fetch_firstdata();

    $("#mda").change(function() {
        fetch_firstdata();
    });

    function export_excel() {
         var mda_id = $("#mda").val();
         route_url=`{{ url('fetch_perexport/`+mda_id+`' ) }}`;
        document.location.href=route_url;
        console.log(route_url);


    }


    function currencyFormat(num) {
        num = parseFloat(num);
        return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    function fetch_firstdata() {
        mda_id = $("#mda").val();
        console.log(mda_id);
        $.ajax({
            url: "{{route('fetch_perdata')}}",
            method: "post",
            data: {
                _token: "{{csrf_token()}}",
                mda_id: mda_id,
            },
            dataType: 'json',
            success: function(result) {
                if (!result.per1[0]['sum']) {
                    result.per1[0]['sum'] = 0;
                }
                if (!result.per2[0]['sum']) {
                    result.per2[0]['sum'] = 0;
                }
                if (!result.per3[0]['sum']) {
                    result.per3[0]['sum'] = 0;
                }
                if (!result.per4[0]['sum']) {
                    result.per4[0]['sum'] = 0;
                }
                if (!result.per5[0]['sum']) {
                    result.per5[0]['sum'] = 0;
                }
                if (!result.per6[0]['sum']) {
                    result.per6[0]['sum'] = 0;
                }
                if (!result.per7[0]['sum']) {
                    result.per7[0]['sum'] = 0;
                }
                if (!result.per8[0]['sum']) {
                    result.per8[0]['sum'] = 0;
                }
                if (!result.per9[0]['sum']) {
                    result.per9[0]['sum'] = 0;
                }
                if (!result.per10[0]['sum']) {
                    result.per10[0]['sum'] = 0;
                }

                tbody = '<tr><td>1-10</td>';
                tbody += '<td>' + result.per1[0]['per'] + '</td>';

                tbody += '<td>' + currencyFormat(result.per1[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>10-20</td>';
                tbody += '<td>' + result.per2[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per2[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>20-30</td>';
                tbody += '<td>' + result.per3[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per3[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>30-40</td>';
                tbody += '<td>' + result.per4[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per4[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>40-50</td>';
                tbody += '<td>' + result.per5[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per5[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>50-60</td>';
                tbody += '<td>' + result.per6[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per6[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>60-70</td>';
                tbody += '<td>' + result.per7[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per7[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>70-80</td>';
                tbody += '<td>' + result.per8[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per8[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>80-90</td>';
                tbody += '<td>' + result.per9[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per9[0]['sum']) + '</td></tr>'

                tbody += '<tr><td>90-100</td>';
                tbody += '<td>' + result.per10[0]['per'] + '</td>';
                tbody += '<td>' + currencyFormat(result.per10[0]['sum']) + '</td></tr>'

                $("tbody").html(tbody);


                // google.charts.load('current', {packages: ['corechart', 'bar']});
                // google.charts.setOnLoadCallback(drawTitleSubtitle);

                // function drawTitleSubtitle() {
                //       var data = google.visualization.arrayToDataTable([
                //          ['% percent', 'OUTSTANDING BALANCE', { role: 'style' }],
                //          ['0-10', 0, 'blue'],            // RGB value
                //          ['10-20', result.per2[0]['sum'], 'blue'],            // RGB value
                //          ['20-30', result.per3[0]['sum'], 'blue'],            // RGB value
                //          ['30-40', result.per4[0]['sum'], 'blue'],            // RGB value
                //          ['40-50', result.per5[0]['sum'], 'blue'],            // RGB value
                //          ['50-60', result.per6[0]['sum'], 'blue'],            // RGB value
                //          ['60-70', result.per7[0]['sum'], 'blue'],            // RGB value
                //          ['70-80', result.per8[0]['sum'], 'blue'],            // RGB value
                //          ['80-90', result.per9[0]['sum'], 'blue'],            // RGB value
                //          ['90-100', result.per10[0]['sum'], 'blue'],            // RGB value
                //       ]);

                //       var options = {
                //         chart: {
                //           title: '%COMPLETION VS OUTSTANDING BALANCE',
                //         },
                //         hAxis: {
                //           title: 'Time of Day',
                //           format: 'h:mm a',
                //           viewWindow: {
                //             min: [7, 30, 0],
                //             max: [17, 30, 0]
                //           }
                //         },
                //         vAxis: {
                //           title: 'Rating (scale of 1-10)'
                //         }
                //       };

                //       var materialChart = new google.charts.Bar(document.getElementById('graph'));
                //       materialChart.draw(data, options);
                //     }

                google.charts.load('current', {
                    packages: ['corechart', 'bar']
                });
                google.charts.setOnLoadCallback(drawTitleSubtitle);

                height_main=$("#main").height();
               

                function drawTitleSubtitle() {
                    var data = google.visualization.arrayToDataTable([
                        ['% percent', 'OUTSTANDING BALANCE', { role: 'style' }],
                         ['0-10', parseInt(result.per1[0]['sum']), ''],            // RGB value
                         ['10-20', parseInt(result.per2[0]['sum']), ''],            // RGB value
                         ['20-30', parseInt(result.per3[0]['sum']), ''],            // RGB value
                         ['30-40', parseInt(result.per4[0]['sum']), ''],            // RGB value
                         ['40-50', parseInt(result.per5[0]['sum']), ''],            // RGB value
                         ['50-60', parseInt(result.per6[0]['sum']), ''],            // RGB value
                         ['60-70', parseInt(result.per7[0]['sum']), ''],            // RGB value
                         ['70-80', parseInt(result.per8[0]['sum']), ''],            // RGB value
                         ['80-90', parseInt(result.per9[0]['sum']), ''],            // RGB value
                         ['90-100', parseInt(result.per10[0]['sum']), '']            // RGB value
                    ]);

                    var options = {
                        height:height_main-50,
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
                            minValue: 0
                            
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
    }
})
</script>


@section('javascript')
<!-- jQuery -->
<script src="{{asset('/dist/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->

<script src="{{asset('/dist/js/demo.js')}}"></script>
<script src="{{asset('/dist/js/pages/dashboard3.js')}}"></script>
@stop

@endsection
