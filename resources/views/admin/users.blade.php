@extends('layouts.master')

@section('content')
<style>
.modal-body>.row {
    margin-top: 20px;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Manage</h1>
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
                            <h3 class="card-title">User Manage</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#add_user">Add
                                        User</button>

                                </div>
                            </div>
                            @if (Session::get('error_msg'))
                            <div class="alert alert-secondary">
                                {{Session::get('error_msg')}}
                            </div>
                            @endif
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>USER NAME</th>
                                        <th>EMAIL</th>
                                        <th>ROLE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $key=> $user)
                                    <tr>
                                        <td>
                                            {{$key+1}}
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Action</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>

                                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">


                                                    <div class="dropdown-menu" role="menu">
                                                        <a class="dropdown-item edit_btn" data-id="{{$user->id}}"
                                                            data-name="{{$user->name}}"
                                                            data-email="{{$user->email}}">Edit</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"
                                                            data-toggle="modal">Delete</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    {{ $users->links() }}
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header align-items-center">

                    <h5 class="modal-title modal-primary">User Create</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>X</span>
                    </button>

                </div>

                <form role="form" method="post" action="{{route('users.store')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">User name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" required placeholder="name:"
                                    require>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">User email:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" required placeholder="email:"
                                    require>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">User role:</label>
                            </div>
                            <div class="col-md-9">
                                <select name="role" id="role" class="form-control" require>
                                    <option value="user">user</option>
                                    <option value="admin">admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">password:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" minlength="5" class="form-control" name="password" required
                                    placeholder="password:" require>
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
    <div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-modal="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header align-items-center">

                    <h5 class="modal-title modal-primary">User Edit</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>X</span>
                    </button>

                </div>

                <form role="form" method="post" action="{{route('users.update','1')}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">user name:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="editname" name="name" required
                                    placeholder="user name:" require>

                                <input type="text" name="id" id="editid" value="" hidden>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="id">user email:</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="editmail" name="email" required
                                    placeholder="user email:" require>
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

    <script>
    $(function() {
        $(".edit_btn").click(function() {
            $('#editid').val($(this).data('id'));
            $('#editname').val($(this).data('name'));
            $('#editmail').val($(this).data('email'));
            $('#edituser').modal('show');
        });
    });
    </script>
</div>
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