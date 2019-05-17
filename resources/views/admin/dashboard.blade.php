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
  welcome to pms<strong>{{ Auth::guard('admin')->user()->name }}!!!</strong>
</section>
</div>
@endsection
