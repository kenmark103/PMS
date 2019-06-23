@extends('admin.main.app')
@section('extracss')
<style media="screen" type="text/css">
.rooms-container .row{
    font-weight:bold;
    }
.rooms-container .row header, .row .c1{
    padding:5px;
}
.rooms-container header{
    border: 5px solid #C1DAD7;
}
.rooms-container .user{
    border: 5px solid #C1DAD7;
    background:#4b8c74;
}
.rooms-container .nouser{
  border: 5px solid #C1DAD7;
  background: #FA8072;
}
</style>
@endsection
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
   <!-- Default box -->
       @if($rooms)
           <div class="box">
               <div class="box-body">
                <ol class="breadcrumb pull-right">
                    <li><a href="{{route('admin.rooms.index')}}">Apartments</a></li>
                    <li class="active">Rooms</li>
                  </ol>
                   <h2>{{$apartment->name}} rooms</h2>
                   <!--include('layouts.search', ['route' => route('admin.customers.index')])-->
                   <div class="rooms-container container-fluid">
                      <div class="row">
                        @foreach($rooms as $room)
                         <div class="col-md-1 {{ $room->users->first() ? 'user' : 'nouser'}} btn btn-primary" data-toggle="modal" data-target="#{{$room->room_no}}Modal"><strong>{{$room->room_no}}</strong></div>
                           <div class="modal fade" id="{{$room->room_no}}Modal">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">{{$room->room_no}}</h4>
                                    <a href="{{route('admin.rooms.edit',$room->id)}}" class="btn btn-default btn-sm">edit</a>
                                    <a href="{{route('admin.rooms.show',$room->id)}}" class="btn btn-default btn-sm">show</a>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                  @if(isset($room->users))
                                   @foreach($room->users as $roomowner => $user)
                                     Room occupied by&nbsp;{{$user->name}}<br>
                                    @endforeach
                                    @endif <br>

                                    @if(isset($room->tenants))
                                   @foreach($room->tenants as $roomtenant)
                                     since &nbsp;{{$roomtenant->created_at->format('d M Y - H:i:s')}}<br>
                                    @endforeach
                                    @endif

                                    @if(isset($room->roompayments))
                                   @foreach($room->roompayments as $roomp)
                                    to &nbsp;{{ date('d M Y', strtotime($roomp->expirydate)) }}<br>
                                    @endforeach
                                    @endif  

                                    <br>

                                  type&nbsp;{{$room->type}}<br>
                                  price&nbsp;{{$room->price}}<br>
                                  <form action="{{ route('admin.bookings.destroy', $room->id) }}" method="post" class="form-horizontal">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="delete">
                                   <div class="btn-group">
                                    <a href="{{route('admin.bookings.show',$room->id)}}" id="assignroombtn" class="btn btn-default btn-sm">assign new user</a>
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" name="clearbutton">clear current user</button>
                                   </div>
                                </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                              </div>
                            </div>
                          </div>
                         @endforeach
                      </div>
                    </div>
                    <a href="{{route('admin.rooms.create')}}" onclick="return confirm('Are you sure?')" type="link" class="btn btn-danger btn-sm" style="margin-top: 1em;"><i class="fa fa-box"></i> Add New Room To Apartment</a>
               </div>
               <!-- /.box-body -->

           </div>
           <!-- /.box -->
       @endif

   </section>
   <!-- /.content -->
 </div>
@endsection
