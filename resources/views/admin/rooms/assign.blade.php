@extends('admin.main.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Rooms</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      @include('shared.errors-and-messages')-->
        <div class="box">
            <div class="header">
              <h2>assign room <small>{{$room->apartment->name}}&nbsp;{{$room->room_no}}</small></h2>
              </div>
              @include('shared.search',['route' => route('admin.bookings.index')])
                <form action="{{ route('admin.bookings.store') }}" method="post" class="form">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <?php if (isset($users)): ?>
                        <div class="users-wrapper">
                          <small>select one user</small>
                          <div class="container py-4 my-4">
                          <?php foreach ($users as $user): ?>
                            <input type="hidden" name="rooms_id" value="{{$room->id}}">
                            <input type="radio" name="users_id" value="{{$user->id}}">
                            <label for="user">{{$user->name}}</label>
                          <?php endforeach; ?>
                         </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-default">Back</a>
                            <button type="submit" class="btn btn-primary">Assign Room</button>
                        </div>
                    </div>
                </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
@endsection
