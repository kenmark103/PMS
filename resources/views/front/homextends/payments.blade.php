@extends('front.home')
@section('main')
<div class="box no-border" style="height: 100vh;">
  <h4 class="py-2 text-me">my payments</h4>
 <div class="box-body">
   <table class="table">
     <tbody>
       <tr>
         <th>Name</th>
         <th>Date</th>
         <th>unique code</th>
         <th>Amount</th>
       </tr>
     </tbody>
     <tbody>
       @if(isset($mypayments))
        @foreach($mypayments as $payment)
        <tr>
        <td>{{$payment->user->name}}</td>
        <td>{{date('d M Y - H:i:s', $payment->created_at->timestamp) }}</td>
        <td>{{$payment->uniqueid}}</td>
        <td>{{$payment->amount}}</td>
        </tr>
        @endforeach
       @endif
     </tbody>
   </table>
 </div>
</div>
@endsection
