@extends('front.home')
@section('main')

<div class="box no-border" style="height: 100vh;">
  <h4 class="py-2">my rooms</h4>
 <div class="box-body">
   <table class="table">
     <tbody>
       <tr>
         <th>Room</th>
         <th>Apartment</th>
         <th>Date start</th>
         <th>Date end</th>
       </tr>
     </tbody>
     <tbody>
       @if(isset($myrooms))
       <tr>
         @foreach($myrooms as $room)
        <td>{{$room->room->room_no}}</td>
        <td>{{$room->room->apartment->name}}</td>
        <td>{{date('d M Y - H:i:s', $room->created_at->timestamp) }}</td>
        <td>{{ date('d M Y', strtotime($room->expirydate)) }}</td>
        @endforeach
       </tr>
       @endif
     </tbody>
   </table>
 </div>
</div>
@endsection
