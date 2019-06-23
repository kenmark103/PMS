@extends('front.home')
@section('main')
<div class="box no-border" style="height: 100vh;">
  <h4 class="py-2 text-me">services</h4>
 <div class="box-body">
  @isset($services)
  <div>
    {{$services}}
  </div>
  @endif
 </div>
</div>
@endsection
