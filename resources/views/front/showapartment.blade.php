@extends('front.layout.app')
@section('extracss')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
@endsection
@section('content')
<?php if (isset($apartment)): ?>
  <div class="container showapartment col-md-11 px-2">
    <div class="row">
      <div class="box col-md-9">
        <section class="box-heading row shadow-sm">
          <div class="house-image col-md-4 py-2">
            <img src="{{asset("storage/$apartment->cover")}}" alt="">
          </div>
          <div class="house-heading col-md-8 py-4">
            <address class=""><h4>{{$apartment->name}}</h4></address>
            <small>{{$apartment->location}}</small>
          </div>
        </section>
        @include('shared.errors-and-messages')

        <div class="box-body">
          <div class="container text-container p-2">
            <p class="text-section">currently available rooms @isset($rooms){{$rooms->count()}}@endif <br>
              <small class="text-primary">Click on tab to view room properties and request a booking</small></p>
            </div>
          <?php if($rooms->count() > 0): ?>
            <div class="rooms-view">
              <div class="container-fluid">
                  <div class="row">
                    <?php foreach ($rooms as $room): ?>
                      <div class="btn btn-default col-md-1 c1" data-toggle="modal" data-target="#modal{{$room->room_no}}">{{$room->room_no}}</div>
                        <!-- The Modal -->
                        <div class="modal" id="modal{{$room->room_no}}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title"><small>room</small>&nbsp;&nbsp;{{$room->room_no}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                                <strong>room details</strong><br>
                                <small>type</small>&nbsp;&nbsp;{{$room->type}}<br>
                                <small>price</small>&nbsp;&nbsp;{{$room->price}}
                              </div>
                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <a href="{{route('front.room.show',$room->id)}}" class="btn btn-default btn-sm">see room</a>
                                <a href="{{route('front.home.edit',$room->id)}}" class="btn btn-default btn-sm">request room</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
          <?php else: ?>
            <div class="alert-danger">
                !no available rooms at the moment!!
            </div>
         <?php endif; ?>
       </div>

        <div class="box-footer py-2 my-2">
          <div class="container text-container p-2">
            <p class="text-section">{{$apartment->name}} room images <br>
            </div>
          <div class="caruosel-wrapper">
            <?php if (isset($roomImages)): ?>
            <div id="roomCarousel" class="carousel slide set-width" data-ride="carousel">
              <!-- Indicators -->
              <ul class="carousel-indicators">
                <li data-target="#roomCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#roomCarousel" data-slide-to="1"></li>
                <li data-target="#roomCarousel" data-slide-to="2"></li>
                <li data-target="#roomCarousel" data-slide-to="3"></li>
              </ul>
              <!-- The slideshow -->
              <div class="carousel-inner">
                @foreach($roomImages as $roomImage => $rm)
                <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                  <img src="{{asset("storage/$rm->source")}}" alt="Los Angeles">
                  <div class="carousel-caption">
                    <h3>{{$rm->apartment->name}}</h3>
                    <p>rooms</p>
                  </div>
                </div>
              @endforeach
              <!-- Left and right controls -->
              <a class="carousel-control-prev" href="#roomCarousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#roomCarousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      </div>
      <aside class="aside-right col-md-3">
        <div class="services my-3 py-2 container">
          <label for=""><b>Services</b></label>
          {{$apartment->description}}
        </div>
        <div class="caretaker py-4">
          <div class="card col-md-10">
            <div class="card-header">
              <caption class="name"><b>{{$apartment->admin->name}} -- <br>admin</b> <i class="fa fa-user fa-lg"></i></caption>
            </div>
            <div class="btn-group contact-cntrl card-body">
              <button type="button" name="button-txt" class="btn btn-primary col-md-4"><i class="fa fa-reply-all"></i></button>
              <button type="button" name="button-call" class="btn btn-success col-md-4"><i class="fa fa-phone"></i></button>
              <button type="button" name="button-mail" class="btn btn-danger col-md-4"><i class="fa fa-envelope"></i></button>
            </div>
            <div class="card-footer">
            <details closed>
              {{$apartment->admin->email}}<br>
              {{$apartment->admin->phonenumber}}
            </details>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
<?php endif; ?>
@endsection
