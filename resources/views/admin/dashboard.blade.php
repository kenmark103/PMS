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
    <div class="container-fluid my-3">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>
                <div class="panel-body">
                    <!--<chat-messages :messages="messages"></chat-messages>-->
                     <ul class="chat">
                      <li class="left clearfix" v-for="message in messages">
                          <div class="chat-body clearfix">
                              <div class="header">
                                  <strong class="primary-font">
                                      
                                  </strong>
                              </div>
                              <p>
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
