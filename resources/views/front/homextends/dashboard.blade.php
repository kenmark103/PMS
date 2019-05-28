@extends('front.home')
@section('main')
 <div class="card col-md-10">
   <div class="card-header dark-purple">
     <strong>
     room @if($room) {{$room->room_no}} {{$room->apartment->name}} @endif
    </strong>
   </div>
   <div class="card-body">
     welcome to your room {{$user->name}}
   </div>
 </div>
 <div class="chat">
   <chat-messages>
     
   </chat-messages>
 </div>
@endsection
