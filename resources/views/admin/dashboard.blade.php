@extends('admin.main.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Widgets
      <small>Preview page</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Widgets</li>
    </ol>
  </section>
  <!-- Main content -->
<section class="content">
  @include('shared.errors-and-messages')
  <div class="box">
    <div class="box-body">
      <div class="payments-section container col-md-10 shadow-sm my-4">
         <div class="my-4" style="margin-top: 2em; margin-bottom: 2em;">
            <h4><b> Add new payment</b></h4>
               <form class="form" action="{{route('admin.payments.store')}}" method="post">
                      @csrf
                 <div class="col-md-5">
                    @isset($customers)
                      <div class="form-group">
                         <label for="uname">Users Name</label>
                          <select class="form-control" name="users_id" id="uname">
                            @foreach($customers as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                             @endforeach
                           </select>
                        </div>
                      @endif
                   <div class="form-group">
                      <label for="amount">Amount paid</label>
                         <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount paid">
                    </div>
                   <div class="form-group">
                      <label for="ucode">Payment code</label>
                        <input type="text" class="form-control" id="ucode" name="uniqueid" placeholder="Unique ID // Unique code">
                    </div>
                   <div class="form-group">
                      <button type="submit" name="addpayment" class="btn btn-primary">Add Payment</button>
                   </div>
                </div>
              </form>
            </div>
          </div>

             <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8" style="margin-top: 2em;">
                        <div class="panel panel-default">
                            <div class="panel-heading"><b>Chats</b></div>
                            <div class="panel-body">
                                <!--<chat-messages :messages="messages"></chat-messages>-->
                                 <ul class="chat">
                                  <li class="left clearfix" v-for="message in messages">
                                      <div class="chat-body clearfix">
                                          <div class="header">
                                              <strong class="primary-font">
                                                  Dr. Heaven Tacot
                                              </strong>
                                          </div>
                                          <p>
                                            No water since yesterday
                                          </p>
                                          <div class="header">
                                              <strong class="primary-font">
                                                  Mrs. Elise Weissnat
                                              </strong>
                                          </div>
                                          <p>
                                            Token has a problem
                                          </p>
                                      </div>
                                  </li>
                                </ul>
                            </div>
                            <div class="panel-footer">
                              <!--<chat-form v-on:messagesent="addMessage" :user="{{ auth()->user() }}"></chat-form>-->
                              <div class="input-group">
                                  <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

                                  <span class="input-group-btn">
                                      <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                                          Send
                                      </button>
                                  </span>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
       </div>
    </section>
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
