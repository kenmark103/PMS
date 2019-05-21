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
.rooms-container .c1{
    border: 5px solid #C1DAD7;
}
.rooms-container .c1{
    background:#4b8c74;
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

   <!--include('layouts.errors-and-messages')-->
   <!-- Default box -->
       @if($rooms)
           <div class="box">
               <div class="box-body">
                   <h2>{{$apartment->name}} rooms</h2>
                   <!--include('layouts.search', ['route' => route('admin.customers.index')])-->
                   <div class="rooms-container container-fluid">
                      <div class="row">
                        @foreach($rooms as $room)
                         <div class="col-md-1 c1"><strong>{{$room->room_no}}</strong></div>
                         @endforeach
                      </div>
                    </div>
                   <table>
                    <tr></tr>
                      <a href="{{route('admin.rooms.create')}}" onclick="return confirm('Are you sure?')" type="link" class="btn btn-danger btn-sm"><i class="fa fa-box"></i> Add New Room To Apartment</a>
                  </table>
               </div>
               <!-- /.box-body -->
           </div>
           <!-- /.box -->
       @endif

   </section>
   <!-- /.content -->
 </div>
@endsection
