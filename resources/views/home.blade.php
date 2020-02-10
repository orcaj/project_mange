@extends('layouts.master')

@section('content')
<style>
.home-control {
    display: flex;
    justify-content: space-evenly;
}
.card{
    overflow:auto;
}
.big-red{
    font-size: 18px;
    color: red;
}

.header-card{
    height: 130px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.item-right{
    display: flex;
    justify-content: flex-end;
    margin-bottom: 10px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1 class="m-0 text-dark">
                        <span style="color:red;">PROJECT MANAGEMENT AND MINTORING OFFICE DASHBOARD</span>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-2">
                    <form id="search_form" class="form-inline" method="post" action="{{route('global_search')}}">
                    @csrf
                    <div class="col-3 home-control"> 
                        <input type="text" class="form-control" id="search" name="keyword" placeholder="Search...">
                        <button type="submit" class="hide" id="search_btn"></button>
                    </div>
                </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-2 col-xxl-3">

                    <div class="card text-center">
                        <div class="card-header bg-primary border-primary text-uppercase p-1 p-xl-2">
                            <b class="common-font-size">Total Projects</b>
                        </div>
                        <div class="card-body p-1 p-xl-2 header-card">
                            <h3>
                                {{$count}}
                            </h3>
                            
                        </div>
                       
                    </div>
                </div>
                <div class="col-md-1 col-xxl-3"></div>

                <div class="col-md-3 col-xxl-3">
                    <div class="card text-center">
                        <div class="card-header bg-dark border-dark text-uppercase p-1 p-xl-2">
                            <b class="common-font-size">TOTAL CONTRACT AMOUNT(N)</b>
                        </div>
                        <div class="card-body p-1 p-xl-2 header-card">
                            <h3>
                                {{ number_format($sum, 2, '.', ',') }} 
                            </h3>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-xxl-3">
                    <div class="card text-center">
                        <div class="card-header bg-danger border-danger text-uppercase p-1 p-xl-2">
                            <b class="common-font-size">TOTAL AMOUNT DISBURSED(N)</b>
                        </div>
                        <div class="card-body p-1 p-xl-2 header-card">
                            <h3>
                                {{ number_format($sum_disbursed, 2, '.', ',') }} 
                            </h3>
                            
                        </div>
                    </div>
                </div> 

                <div class="col-md-3 col-xxl-3">
                    <div class="card text-center">
                        <div class="card-header bg-secondary border-secondary text-uppercase p-1 p-xl-2">
                            <b class="common-font-size">TOTAL BALANCE PAYMENT ON PROJECTS(N)</b>
                        </div>
                        <div class="card-body p-1 p-xl-2 header-card">
                            <h3>
                                {{ number_format($sum_balance, 2, '.', ',') }} 
                            </h3>
                            
                        </div>
                    </div>
                </div>          

            </div>

            <div class="row">
                <b style="margin: auto; font-size: 1.3rem; color:red;">PROJECTS BY THE MINISTRIES, DEPARTMENTS AND AGENCIES (MDA).</b>
            </div>


            <div class="row">
                @foreach($mdas as $key => $mda)

                <div class="col-md-2 col-xxl-3">
                    <a href="{{route('mda_info', $mda->id)}}">

                        <!-- <div class="card text-center" style="background: #e6cccc; color:red"> -->
                        <div class="card text-center" style="background-image: url('img/{{$mda->mda_name}}.jpg');background-size: 100%; color:red">
                            
                            <div class="card-body p-1 p-xl-2 header-card">
                                <h6>
                                    <b style="color:white;">{{$mda->mda_name}}</b>
                                </h6>
                                
                            </div>
                           
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
var search = document.getElementById("search");
search.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("search_btn").click();
  }
});
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