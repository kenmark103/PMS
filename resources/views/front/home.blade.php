@extends('front.layout.app0')
@section('content')
<section class="intro-single">
</section>
  <div class="row">
  <aside class="home-aside left col-md-3">
    <div class="nav-side-menu">
    <div class="brand"><i class="fa fa-home fa-lg" aria-hidden="true"></i></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out text-white">
              <a href="{{route('front.home.index')}}" class="{{ Request::is('/home') ? 'active' : '' }}">
                <li class="text-white"><i class="fa fa-dashboard"></i>User Dashboard</li>
              </a>
              <a href="{{route('front.home.show',auth()->id())}}" class="{{ Request::is('/payments') ? 'active' : '' }}">
                <li class="text-white"><i class="fa fa-bank "></i> Payments</li>
               </a>
               <a href="{{route('home.showrooms',auth()->id())}}" class="{{ Request::is('/showroom') ? 'active' : '' }}">
                 <li class="text-white"><i class="fa fa-hotel "></i> Rooms</li>
               </a>
               <a href="{{route('home.notices')}}" class="{{ Request::is('/notices') ? 'active' : '' }}">
                 <li class="text-white"><i class="fa fa-bell "></i> Notices</li>
               </a>
               <a href="{{route('home.services',auth()->id())}}" class="{{ Request::is('/services') ? 'active' : '' }}">
                 <li class="text-white"><i class="fa fa-globe text-white"></i> Services</li>
                </a>
               <a href="#">
                <li data-toggle="collapse" data-target="#service" class="collapsed text-white">
                  <i class="fa fa-user "></i> Profile <span class="arrow"></span>
                </li>
              </a>
                <ul class="sub-menu collapse" id="service">
                  <a href="#"><li>profile</li></a>
                </ul>
            </ul>
     </div>
</div>
</aside>

  <main class="main col-md-9">
    @yield('main')
    <section class="bottom mt-5">
      @if(isset($apartments))
       <div class="container-fluid">
        <p class="heading text-center text-me" role="title">similar rooms</p>
         <div class="row">
          @foreach($apartments as $apartment)
           <a href="{{route('front.apartments.show',$apartment->id)}}" class="col-md-3">
             <img src="{{asset("storage/$apartment->cover")}}" style="width:50%; height: 8em; border-radius:50%;">
             <caption class="text-center px-2">{{$apartment->name}}</caption>
           </a>
           @endforeach
         </div>
         @endif
       </div>
     </section>
  </main>
 </div>
 </div>
@endsection
