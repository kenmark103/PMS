@extends('front.layout.app')
@section('content')
<div class="content">
  <?php if ($apartments): ?>
    <div class="apartments-cover container-fluid">
      <div class="heading row shadow-sm">
        <div class="subheading col-md-3 py-2">
          <h3 class="">Apartments</h3>
        </div>
        <div class="search-container col-md-9 py-2">
          <strong>Filter room</strong>
          <select class="select" name="">
            <option value="">Apartment</option>
            <option value="">Awesome</option>
            <option value="">Royals</option>
            <option value="">Pink</option>
            <option value="">Blacks</option>
            <option value="">Legends</option>
          </select>
          <select class="select" name="">
            <option value="">Location</option>
            <option value="">Narok</option>
            <option value="">Eldoret</option>
            <option value="">Juja</option>
            <option value="">Mombasa</option>
            <option value="">Nairobi</option>
          </select>
          <select class="select" name="">
            <option value="">price</option>
            <option value="">10,000</option>
            <option value="">20,000</option>
            <option value="">30,000</option>
            <option value="">above</option>
          </select>
          <select class="select" name="">
            <option value="">type</option>
            <option value="">bedsitter</option>
            <option value="">1 bedroom</option>
            <option value="">2 bedroom</option>
          </select>
          <button type="submit" name="button" class="btn btn-default">Search</button>
        </div>
      </div>
      <div class="row">
        <?php foreach ($apartments as $apartment): ?>
          <a href="{{route('front.apartments.show',$apartment->id)}}" class="apartment-wrapper col-md-4 shadow-sm my-2">
              <div class="image-section">
                <img src="{{asset("storage/$apartment->cover")}}" alt="">
              </div>
              <address class="address-block">
                <strong id="apartment">{{$apartment->name}}</strong><br>
                <small id="location">location: {{$apartment->location}}</small><br>
                <small id="rooms">rooms:<span class="room-color">{{$apartment->rooms->count()}}</span></small>
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
