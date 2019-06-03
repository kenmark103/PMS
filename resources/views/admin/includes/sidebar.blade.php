<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p> {{ Auth::guard('admin')->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="{{route('admin.payments.index')}}">
          <i class="fa fa-eur"></i> <span>Finances</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @if(auth('admin')->user()->isSuperAdmin())
          <li><a href="{{route('admin.payments.index')}}"><i class="fa fa-circle-o"></i>Show</a></li>
          @endif
          <li><a href="{{route('admin.payments.show',auth('admin')->id())}}"><i class="fa fa-circle-o"></i>List</a></li>
        </ul>
      </li>
      
      <li class="treeview">
        <a href="">
          <i class="fa fa-table"></i> <span>Apartments</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.apartments.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
          <li><a href="{{route('admin.apartments.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Rooms</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.rooms.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
          <li><a href="{{route('admin.rooms.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-pie-chart"></i>
          <span>Customers</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.customers.index')}}"><i class="fa fa-circle-o"></i> List</a></li>
          <li><a href="{{route('admin.customers.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="">
          <i class="fa fa-laptop"></i>
          <span>Bookings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.rmBkngs.index')}}"><i class="fa fa-circle-o"></i> List</a></li>
        </ul>
      </li>
<?php if (auth('admin')->user()->isSuperAdmin()): ?>
      <li class="treeview">
        <a href="">
          <i class="fa fa-laptop"></i>
          <span>Employees</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('admin.employees.index')}}"><i class="fa fa-circle-o"></i>List</a></li>
          <li><a href="{{route('admin.employees.create')}}"><i class="fa fa-circle-o"></i>Create</a></li>
        </ul>
      </li>
<?php endif; ?>
      <li><a href=""><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      <li class="header">LABELS</li>
      <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
      <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
