@extends('front.home')
@section('main')
<div class="card-wrapper col-md-8 col-md-offset-2">
  <div class="card">
    <div class="title py-2 px-2">
      <h5>{{$room->apartment->name}} Apartment &nbsp; Room{{$room->room_no}}</h5>
    </div>
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
                              Send <i class="fa fa-reply fa-lg"></i>
                          </button>
                      </span>
                  </div>
                </div>
            </div>
        </div>
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
