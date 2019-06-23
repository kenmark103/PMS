@extends('front.home')
@section('main')
@include('shared.errors-and-messages')
<div class="card-wrapper col-md-8 col-md-offset-2">
  <div class="card">
    @if(isset($room))
    <div class="title py-2 px-2">
      <h4 class="text-me">{{$room->apartment->name}} Apartment &nbsp; Room{{$room->room_no}}</h4>
    </div>
    @endif
  </div>
</div>
 <div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default" id="app">
                <div class="card-header card-purple">Chats <span class="ml-auto pull-right">message to caretaker<i class="fa fa-user"></i></span></div>
                <div class="card-body">
                    <!--<chat-messages :messages="messages"></chat-messages>-->
                     <ul class="chat">
                      <li class="left clearfix" v-for="message in messages">
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <strong class="primary-font">{{$user->name}}
                                  </strong>
                              </div>
                              <p>
                                new message
                              </p>
                          </div>
                      </li>
                    </ul>
                </div>
                <div class="card-footer">
                  <!--<chat-form v-on:messagesent="addMessage" :user="{{ auth()->user() }}"></chat-form>-->
                  <div class="input-group">
                      <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
                      <span class="input-group-btn">
                          <button class="btn btn-primary btn-sm py-2" id="btn-chat" @click="sendMessage">
                              Send <i class="fa fa-reply fa-sm"></i>
                          </button>
                      </span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <h4 class="my-4">Payments Container</h4>
  <div class="row">
  <div class="payment-section col-md-8">
  <h5>Mpesa api token</h5>
  <p class="text-danger" role="alert">If you need to make online payment</p>
  <form class="form" action="{{route('home.mpesa')}}" method="post">
    @csrf
    <div class="col-md-10">
      <div class="form-group">
        <label for="account-details">Account</label>
        <input type="text" name="account" id="account-details" class="form-control" placeholder="account number ie 0254445212" data-rule="min:8" data-msg="minimum of 8 characters of subject" value="{{old('account')}}">
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="your mobile number {{$user->phonenumber}}" data-rule="min:10" data-msg="Please enter a valid phone number" value="{{old('phone')}}">
      </div>
      <div class="form-group">
        <label for="amounta">Amount</label>
        <input type="text" name="amounta" id="amounta" class="form-control" placeholder="amount" data-rule="" data-msg="Please enter amount in numerals" value="{{old('amounta')}}">
      </div>
      <div class="form-group">
         <label for="pin">Pin</label>
        <div class="input-group col-md-8">
            <input id="pin" type="text" name="pin" class="form-control input-sm" placeholder="Type your mpesa pin here" v-model="newMessage" @keyup.enter="sendMessage">
            <span class="input-group-btn">
                <button class="btn btn-success btn-sm py-2" id="btn-send" @click="sendMessage">
                    Send <i class="fa fa-bank fa-sm"></i>
                </button>
            </span>
        </div>
      </div>
  <div class="form-group my-2">
    <label for="upload-image">Upload image of receipt etc</label>
    <input type="file" name="upload-image" value="" id="upload-image">
  </div>
</div>
</form>
  <div class="col-md-10 py-2 my-4">
    <h5 class="my-2">Add payment</h5>
    <p class="text-danger" role="alert">if you have already made payment</p>
    <form class="form" action="{{route('front.home.store')}}" method="post">
     @csrf
        <div class="form-group">
          <label for="uname">User Name</label>
          <select class="form-control" name="users_id" id="uname">
            <option value="{{auth()->id()}}">{{auth()->user()->name}}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="amount">Amount paid</label>
          <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount paid">
        </div>
        <div class="form-group">
          <label for="ucode">Payment code</label>
          <input type="text" class="form-control" id="ucode" name="uniqueid" placeholder=" Unique code NZX89HSCF">
        </div>
        <div class="btn-group">
          <button type="submit" name="addpayment" class="btn btn-primary">Add Payment</button>
        </div>
    </form>
  </div>
</div>
  <div class="col-md-4">
    <h5>Select preferred room</h5>
     <p class="text-danger" role="alert"> * only empty rooms available </p>
     @isset($free)
      <div class="form-group">
      <label for="apartment">Apartment</label> 
       <select class="select form-control" name="apartment" id="apartment">
         <option value="">-- Select apartment --</option>
         @foreach($free as $id => $apartment)
          <option value="{{$id}}"> {{ucfirst($apartment->name)}} </option>
         @endforeach 
       </select>
     </div>
     <div class="form-group">
      <label for="room">Rooms</label> 
       <select class="select form-control" name="room" id="room">
       </select>
     </div>
     <div class="form-group">
      <label for="room">Price</label> 
       <select class="select form-control" name="price" id="price">
       </select>
     </div>
      <p class="text-danger" role="alert"> not necessary </p>
     @endif
  </div>
</div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script>
         $(document).ready(function() {
        $('#apartment').on('change', function() {
            var apartmentID = $(this).val();
            if(apartmentID) {
                $.ajax({
                    url: '/get_by_apartment/'+apartmentID,
                    type: "GET",
                    data : {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success:function(data) {
                        //console.log(data);
                      if(data){
                        $('#room').empty();
                        $('#room').focus;
                        $('#room').append('<option value="">-- Select Room --</option>'); 
                        $.each(data, function(key, value){
                        $('select[name="room"]').append('<option value="'+ key +'">' + value.room_no+ '</option>');
                    });
                  }else{
                    $('#room').empty();
                  }
                  }
                });
            }else{
              $('#room').empty();
            }
        });
    });
    </script>
@endsection
