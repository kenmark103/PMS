@extends('front.layout.app')
@section('content')
  <div class="row">
  <aside class="home-aside left col-md-3">
    <div class="nav-side-menu">
    <div class="brand"><i class="fa fa-home fa-lg" aria-hidden="true"></i></div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="{{route('front.home.index')}}">
                  <i class="fa fa-dashboard"></i>User Dashboard
                  </a>
                </li>
                <li>
                 <a href="#">
                 <i class="fa fa-bell"></i> Notices
                 </a>
                 </li>
                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-globe"></i> Services <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="service">
                  <li>New Service 1</li>
                  <li>New Service 2</li>
                </ul>

                 <li>
                  <a href="#">
                  <i class="fa fa-user"></i> Profile
                  </a>
                  </li>
            </ul>
     </div>
</div>
</aside>

  <main class="main col-md-9">
    @yield('main')
  </main>
 </div>
</div>
@endsection
