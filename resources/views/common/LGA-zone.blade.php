@extends('layouts.master')

@section('content')
<style>
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
                    <h1 class="m-0 text-dark">PROJECTS BY LGA/SENATORIAL ZONE</h1>
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
                            <h3 class="card-title">PROJECTS BY LGA/SENATORIAL ZONE</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>MDA</th>
                                        <th>SENATORIAL ZONE</th>
                                        <th>L.G.A</th>
                                        <th>PROJECTS COUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $key=>$data)
                                    <tr>
                                        <td>
                                            {{$data->mda_name}}
                                        </td>
                                        <td>{{$data->senatorial_zone}}</td>
                                        <td>{{$data->location}}</td>
                                        <td>{{$data->mda_count}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
<script type="text/javascript">
    function export_excel() {
        document.location.href="{!! route('fetch_countexport','counts'); !!}";
    }
    
    $(document).ready(function(){

        $("#export").on('click',function(){
            export_excel();
        })
    });
</script>

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