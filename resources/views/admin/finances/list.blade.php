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
                    <h2>payments</h2>
                    @include('shared.search', ['route' => route('admin.payments.show',auth('admin')->id())])
                    @if(isset($payments))
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-1">Id</td>
                                <td class="col-md-3">Name</td>
                                <td class="col-md-3">Date</td>
                                <td class="col-md-3">Payment ID</td>
                                <td class="col-md-2">Amount</td>
                            </tr>
                        </tbody>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{$payment->user->name}}</td>
                                <td>{{date('d M Y - H:i:s', $payment->created_at->timestamp) }}</td>
                                <td>{{$payment->uniqueid}}</td>
                                <td>{{$payment->amount}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    <table>
                      <tbody>
                        <strong>no payments available!</strong>
                      </tbody>
                    </table>
                  @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="btn-group">
                      <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                  </div>
                </div>
                {{$payments->links()}}
            </div>
            <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection
