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
        <!-- Default box -->
        <div class="box">
            <div class="box-body">
              <h2>{{$apartment->name}}</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="col-md-2"><i>location</i></td>
                            <td class="col-md-3"><i>description</i></td>
                            <td class="col-md-7"><i>cover</i></td>
                        </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <td>{{$apartment->location }}</td>
                        <td>{{$apartment->description}}</td>
                        <td><img src="{{asset("storage/$apartment->cover")}}" style="width:100%;"></td>
                    </tr>
                    </tbody>
                </table>
                @if($roomImages)
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="col-md-3"><i>rooms</i></td>
                            <td class="col-md-3"><i></i></td>
                            <td class="col-md-3"><i></i></td>
                            <td class="col-md-3"><i></i></td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            @foreach($roomImages as $room)
                            <td><img src="{{asset("storage/$room->source")}}" style="width:100%;max-height:25rem;"></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                @endif
                <table class="table">
                  <tbody>
                    <th class="col-md-2">Contact</th>
                    <th class="col-md-2">Phone</th>
                  </tbody>
                  <tbody>
                    <td>{{$apartment->admin->name}}</td>
                    <td>{{$apartment->admin->phonenumber}}</td>
                  </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.apartments.index') }}" class="btn btn-default btn-sm">Back</a>
                </div>
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection
