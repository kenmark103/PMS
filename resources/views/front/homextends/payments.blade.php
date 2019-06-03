@extends('front.home')
@section('main')
<div class="box no-border" style="height: 100vh;">
  <h4 class="py-2">my payments</h4>
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
       <tr>
         @foreach($mypayments as $payment)
        <td>{{$payment->user->name}}</td>
        <td>{{date('d M Y - H:i:s', $payment->created_at->timestamp) }}</td>
        <td>{{$payment->uniqueid}}</td>
        <td>{{$payment->amount}}</td>
        @endforeach
       </tr>
       @endif
     </tbody>
   </table>
 </div>
</div>
@endsection
