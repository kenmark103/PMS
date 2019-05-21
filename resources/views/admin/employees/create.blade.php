@extends('admin.main.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>
    <!-- Main content -->
<section class="content">
    @include('shared.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.employees.store') }}" method="post" class="form">
            <div class="box-body">
              <h2>Create employee</h2>
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="form-group">
                    <label for="phonenumber">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="phonenumber" id="phonenumber" placeholder="phone number" class="form-control" value="{{ old('phone') }}">
                </div>
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" placeholder="xxxxx" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">Role </label>
                    <select name="role" id="role" class="form-control">
                        <option value="1">Superadmin</option>
                        <option value="2">Care taker</option>
                    </select>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>
@endsection
