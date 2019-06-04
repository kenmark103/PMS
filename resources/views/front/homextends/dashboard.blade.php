@extends('front.home')
@section('main')
@include('shared.errors-and-messages')
<div class="card-wrapper col-md-8 col-md-offset-2">
  <div class="card">
    @if(isset($room))
    <div class="title py-2 px-2">
      <h5>{{$room->apartment->name}} Apartment &nbsp; Room{{$room->room_no}}</h5>
    </div>
    @endif
  </div>
</div>
 <div class="container-fluid my-4">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
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

<div class="container payment-section">
  <h4>Validator api token</h4>
  <form class="" action="" method="post">
    <div class="col-md-10">
      <div class="form-group">
        <label for="account-details">Account</label>
        <input type="text" name="account" id="account-details" class="form-control" placeholder="account number ie 0254445212">
      </div>
      <div class="form-group">
        <div class="input-group col-md-8">
            <input id="paymnt-input" type="text" name="payment" class="form-control input-sm" placeholder="Type your payment code here ie. NZXccVB879" v-model="newMessage" @keyup.enter="sendMessage">
            <span class="input-group-btn">
                <button class="btn btn-success btn-sm py-2" id="btn-send" @click="sendMessage">
                    Send <i class="fa fa-bank fa-sm"></i>
                </button>
            </span>
        </div>
      </div>
  <div class="form-group">
    <label for="upload-image">Upload image of receipt etc</label>
    <input type="file" name="upload-image" value="" id="upload-image">
  </div>
</div>
</form>
  <div class="col-md-10">
    <h4>Add payment</h4>
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
          <input type="text" class="form-control" id="ucode" name="uniqueid" placeholder="Unique ID // Unique code">
        </div>
        <div class="btn-group">
          <button type="submit" name="addpayment" class="btn btn-primary">Add Payment</button>
        </div>
    </form>
  </div>
</div>
<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }
    }
</script>
@endsection
