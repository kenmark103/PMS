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

    <!-- Default box -->
            <div class="box">
                <div class="box-body">
                    <h2>Bookings</h2>
                    @include('shared.search', ['route' => route('admin.bookings.index')])
                    @if(isset($bookings))
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-3">Date</td>
                                <td class="col-md-2">apartment</td>
                                <td class="col-md-2">room</td>
                                <td class="col-md-3">Customer</td>
                                <td class="col-md-2">Phonenumber</td>
                                
                            </tr>
                        </tbody>
                        <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td><a title="Show order" href="{{route('admin.bookings.show',$booking->room->id)}}">{{date('d M Y - H:i:s', $booking->created_at->timestamp) }}</a></td>
                                <td>{{$booking->apartment->name}}</td>
                                <td>{{$booking->room->room_no}}</td>
                                <td>{{$booking->user->name}}</td>
                                <td>{{$booking->user->phonenumber}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <table>
                      <tbody>
                        <strong>no booking available!</strong>
                      </tbody>
                    </table>
                  @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{$bookings->links()}}
                </div>
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection
