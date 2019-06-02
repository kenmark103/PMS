@extends('admin.main.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>
<!-- Main content -->
   <section class="content">

   @include('shared.errors-and-messages')
   <!-- Default box -->
       @if($apartments)
           <div class="box">
               <div class="box-body">
                   <h2>Apartments</h2>
                   <!--include('layouts.search', ['route' => route('admin.customers.index')])-->
                   <div class="apartments-container">
                      @foreach($apartments as $apartment)
                         <div class="col-md-3">
                           <div class="cover"><img src="{{asset("storage/$apartment->cover")}}" class="image-resposive" alt="{{$apartment->slug}}" style="width:100%; max-height: 15rem;"></div>
                           <header>name: {{$apartment->name}}</header>
                            <small>contact: {{$apartment->admin->name}}</small>
                            <address>location: {{$apartment->location}}</address>
                           <div class="form-group">
                             <form action="{{ route('admin.apartments.destroy', $apartment->id) }}" method="post" class="form-horizontal">
                                      {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="delete">
                                      <div class="btn-group">
                                          <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i> Show</a>
                                          <?php if (auth('admin')->user()->isSuperAdmin()): ?>
                                          <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                          <button onclick="return confirm('Are you sure? All apartment records will be lost without a way to retrieve them')" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Delete</button>
                                          <?php endif; ?>
                                      </div>
                                  </form>
                              </div>
                          </div>
                        @endforeach
                   </div>
               </div>
               <!-- /.box-body -->
               @if($admin)
               <div class="container">
                 <a href="{{route('admin.apartments.create')}}"><button type="btn" name="links" class="btn btn-primary"> new apartment</button></a>
               </div>
               @endif
           </div>
           <!-- /.box -->
       @endif

   </section>
   <!-- /.content -->
 </div>
@endsection
