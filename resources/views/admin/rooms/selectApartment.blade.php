@extends('admin.main.app')
@section('extracss')
<style media="screen">
    ul.apts {
      list-style-type: none;
    }
    li.apt {
      display: inline-block;
    }

    input.apt-input[type="checkbox"]{
      display: none;
    }

    label.apt-label {
      border: 1px solid #fff;
      padding: 10px;
      display: block;
      position: relative;
      margin: 10px;
      cursor: pointer;
      -webkit-touch-callout: none;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    label.apt-label::before {
      background-color: white;
      color: white;
      content: " ";
      display: block;
      border-radius: 50%;
      border: 1px solid grey;
      position: absolute;
      top: -5px;
      left: -5px;
      width: 25px;
      height: 25px;
      text-align: center;
      line-height: 28px;
      transition-duration: 0.4s;
      transform: scale(0);
    }

    label.apt-label img {
      height: 100px;
      width: 100px;
      transition-duration: 0.2s;
      transform-origin: 50% 50%;
    }

    :checked+label.apt-label {
      border-color: #ddd;
    }

    :checked+label.apt-label::before {
      content: "✓";
      background-color: grey;
      transform: scale(1);
    }

    :checked+label.apt-label img {
      transform: scale(0.9);
      box-shadow: 0 0 5px #333;
      z-index: -1;
    }
    </style>
  @endsection
  
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
                   <h2>select apartment</h2><small class="small-danger">note:you can only view your apartment as caretaker or admin</small>
                   <!--include('layouts.search', ['route' => route('admin.customers.index')])-->
                   <div class="container">
                    <ul class="apts row">
                      @foreach($apartments as $apartment)
                      <li class="apt">
                        <input type="checkbox" id="{{$apartment->name}}" class="apt-input radio">
                        <label for="{{$apartment->name}}" class="apt-label"><img src="{{asset("storage/$apartment->cover")}}"></label>
                        <a href="{{ route('admin.rooms.showRoom', $apartment->id) }}" class="btn btn-default btn-sm">{{$apartment->name}}</a>
                      </li>
                      @endforeach
                    </ul>
                   </div>
                    <button onclick=""  class="btn btn-default">View multiple apartments</button>
               </div>
               <!-- /.box-body -->
           </div>
           <!-- /.box -->
       @endif

   </section>
   <!-- /.content -->
 </div>
@endsection
