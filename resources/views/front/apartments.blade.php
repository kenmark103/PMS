@extends('front.layout.app')
@section('content')
<div class="content">
  <?php if ($apartments): ?>
    <div class="apartments-cover container-fluid">
      <div class="row">
        <?php foreach ($apartments as $apartment): ?>
          <a href="{{route('front.apartments.show',$apartment->id)}}" class="apartment-wrapper col-md-4 shadow-sm my-2">
              <div class="image-section">
                <img src="{{asset("storage/$apartment->cover")}}" alt="">
              </div>
              <address class="address-block">
                <strong id="apartment">{{$apartment->name}}</strong><br>
                <small id="location">location: {{$apartment->location}}</small>
              </address>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php else: ?>
        <div class="no-apartment">
          <h4 class="title text-center">
            !no apartment available!!
          </h4>
        </div>
      <?php endif ?>
  </div>
@endsection
