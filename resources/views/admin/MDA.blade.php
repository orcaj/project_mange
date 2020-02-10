@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">MDA Manage</h1>
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

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">MDA Manage</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_mda">Add
                                        MDA</button>
                                </div>
                            </div>
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>MDA NAME</th>
                                        <th>SHORT NAME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mdas as $key =>$mda)
                                    <tr>

                                        <td>
                                            {{$key+1}}
                                        </td>
                                        <td>
                                            {{$mda->mda_name}}
                                        </td>
                                        <td>
                                            {{$mda->short_name}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item edit_btn" data-id="{{$mda->id}}" 
                                                        data-name="{{$mda->mda_name}}" data-short="{{$mda->short_name}}"
                                                        >Edit</a>
                                                    <a class="dropdown-item"
                                                        href="{{route('delete_mda', $mda->id)}}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{ $mdas->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="add_mda" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header align-items-center">

                    <h5 class="modal-title modal-primary">MDA Create</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>X</span>
                    </button>

                </div>

                <form role="form" method="post" action="{{route('mda_create')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">MDA name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="mda_name" required placeholder="MDA name:"
                                    require>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">Short name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="short_name" required placeholder="Short name:"
                                    require>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span>Close Form</span>
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Modal edit -->
    <div class="modal fade" id="editmda" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header align-items-center">

                    <h5 class="modal-title modal-primary">MDA Edit</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>X</span>
                    </button>

                </div>

                <form role="form" method="post" action="{{route('mda_edit')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">MDA name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="editname" name="mda_name" required
                                    placeholder="MDA name:" require>

                                <input type="text" name="id" id="editid" value="" hidden>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">Short name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="editshortname" name="short_name" required
                                    placeholder="Short name:" require>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            <span>Close Form</span>
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- /.content -->
</div>
<script>
$(function(){
    $(".edit_btn").click(function(){
        $('#editid').val($(this).data('id'));
        $('#editname').val($(this).data('name'));
        $('#editshortname').val($(this).data('short'));
        $('#editmda').modal('show');
    });
});
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