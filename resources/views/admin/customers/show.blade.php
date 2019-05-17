
@extends('admin.layout.app')
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

        <!-- Default box -->
        <div class="box">
            <div class="box-body">
                <h2>Customer Account</h2>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="col-md-4">ID</td>
                        <td class="col-md-4">Name</td>
                        <td class="col-md-4">Email</td>
                        <td class="col-md-4">Phone</td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phonenumber }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-body">
                <strong>Images</strong>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="col-md-2">Date</td>
                        <td class="col-md-2">Booking</td>
                        <td class="col-md-2">Actions</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-body">
                <strong>Events</strong>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="col-md-2">Event name</td>
                        <td class="col-md-2">Date</td>
                        <td class="col-md-2">Location</td>
                        <td class='col-md-2'>Status</td>
                    </tr>
                    </tbody>
                    @if(isset($customer->eventBkings))
                    <tbody>
                        @foreach($customer->eventBkings as $eventb )
                    <tr>
                        <td class="col-md-2">{{$eventb->event}}</td>
                        <td class="col-md-2">{{$eventb->event}}</td>
                        <td class="col-md-2">{{$eventb->event}}</td>
                        <td class="col-md-2"></td>
                    </tr>
                        @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
            <div class="box-body">
                <strong>Bookings</strong>
                <table class="table">
                    <tbody>
                    <tr>
                        <td class="col-md-2">Type</td>
                        <td class="col-md-2">Date</td>
                        <td class="col-md-2">Status</td>
                    </tr>
                    </tbody>
                    @if(isset($customer->bookings))
                    <tbody>
                        @foreach($customer->bookings as $bkn)
                    <tr>
                        <td class="col-md-2">{{$bkn->title}}</td>
                        <td class="col-md-2">{{$bkn->date}}</td>
                        <td class="col-md-2">{{$bkn->status}}</td>
                    </tr>
                        @endforeach
                    </tbody>  
                    @endif
                </table>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Back</a>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
@endsection
