@extends('front.layout.app')
@section('content')
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
    </div>
        <div class="box-footer">
        	
        </div>
@endsection