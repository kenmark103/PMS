@extends('front.layout.app0')
@section('content')
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">RM {{$room->room_no}}</h1>
            <span class="color-text-a">{{$room->apartment->location}}</span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{url('/')}}">Home</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('front.apartments.index')}}">Properties</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('front.apartments.show',$room->apartment->id)}}">{{$room->apartment->name}}</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                {{$room->room_no}}
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
 <div class="container showroom col-md-11 px-2">
    <div class="row">
      <div class="box col-md-9">
        <section class="box-heading row shadow-sm">
        	<div class="house-image col-md-4 py-2">
            <img src="{{asset("$$room->apartment->cover")}}" alt="">
          </div>
          <div class="house-heading col-md-8 py-4">
            <address class=""><h4>{{$room->apartment->name}}</h4></address>
            <small>{{$room->apartment->location}}</small>
            <h4>room {{$room->room_no}}</h4>
          </div>
        </section>
        @include('shared.errors-and-messages')
        <div class="box-body">
        	<p class="py-2 my-2 well"><b>Room Images</b></p>
        	<div class="rooms-wrapper shadow-sm">
        		@if(isset($images))
	        	<div class="row">	
	        		@foreach($images as $image)
	        			<div class="col-md-6">
	        				<img src="{{asset("storage/$image->source")}}" alt="" style="width:100%; max-height:20rem;">
	        			</div>
	        		@endforeach
	        	</div>
        		@endif
        	</div>
        </div>
    </div>
    <div class="col-md-3">
    	<h4 class="services"> Services </h4>
    	<div class="container">
    		{{$room->apartment->description}}
    	</div>
    	<div class="my-2 py-2">
    		<a href="{{route('front.home.edit',$room->id)}}" class="btn btn-success">book room</a>
    	</div>
        <div class="box-side my-4 py-3">
        <h5>Room details</h5>
        <label for="type">Type</label>
        <p id="type">{{$room->type}}</p>
        <label for="price">Price</label>
        <p id="price">{{$room->price}}</p>  
        </div>
    </div>
    </div>
</div>
@endsection