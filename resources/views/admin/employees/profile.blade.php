@extends('admin.layout.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Employee
        <small>Profile</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!--include('layouts.errors-and-messages')-->
        <form action="{{ route('admin.employee.profile.update', $employee->id) }}" method="post" class="form">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-4">Name</td>
                                <td class="col-md-4">Email</td>
                                <td class="col-md-4">Password</td>
                            </tr>
                        </tbody>
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input name="name" type="text" class="form-control" value="{{ $employee->name }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="email" type="email" class="form-control" value="{{ $employee->email }}">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control" value="" placeholder="xxxxxx">
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-default btn-sm">Back</a>
                        <button class="btn btn-success btn-sm" type="submit"> <i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </form>

    </section>
    <!-- /.content -->
 </div>
@endsection
