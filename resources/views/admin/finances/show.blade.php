@extends('admin.main.app')
@section('extracss')
<style media="screen">
.finances{
  -webkit-box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.35);
 -moz-box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.35);
 box-shadow: 1px 1px 1px 0px rgba(0,0,0,0.35);
 padding: 1em;

}
.finances .heading{
 min-height: 8rem;
 max-height: 15rem;
 background-color: #004422;
 color: #f8fafc;
 font-weight: bold;
 line-height: normal;
 padding: auto;
 border-radius: 3px;
 padding-top: 1em;
}

.finances .assets{
  height: 10rem;
  font-weight: bold;
  padding: 1em;
  justify-content: center;
  align-content: center;
}
.finances .account-statement{
  height: 8rem;
  color: #f8fafc;
  font-weight: bold;
  line-height: normal;
  padding: auto;
  border-radius: 3px;

}
.account{
  background-color: #f66d9b;
  height: inherit;
  padding-top: .5em;
  padding: .5em;
}
.aparments-finance-wrapper{
  margin-top: 2em;
  background-color: #c9df8a;
}
.finances .apartment{
 height: 15em;
 margin: 1em 2em;
 background-color: #f0f7da;
}
.apartment .highlight{
  background-color: #44bb99;
  color: #f8fafc;
  font-weight: 300;
  padding: 3px;
  border-radius: 2px;
}
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h2>Finances
        <small></small>
      </h2>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Home</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

    <!-- Default box -->

                  <div class="container-fluid finances">
                    <div class="row">
                      <div class="col-md-10 col-md-offset-1">
                        <section class="heading shadow-sm">
                          <h4 class="col-md-4 shadow-sm text-center">Your income statement is <b>@isset($monthlyIncome)${{$monthlyIncome}} @endif</b></h4>
                          <h4 class="col-md-4 shadow-sm text-center">expected revenue <b>@isset($expectedIncome)${{$expectedIncome}} @endif</b></h4>
                          <h4 class="col-md-4 shadow-sm text-center">apartments maximum <b>@isset($maxReturns)${{$maxReturns}}@endif</b></h4>
                        </section>
                        <section class="assets text-center">
                          <div class="col-md-3 shadow-sm">
                            Total apartment rooms <br>
                            <h3>@isset($rooms){{$rooms->count()}}@endif</h3>
                          </div>
                          <div class="col-md-3 shadow-sm">
                            Occupied rooms total <br>
                            <h3>@isset($Orooms){{$Orooms->count()}}@endif</h3>
                          </div>
                        <div class="col-md-3 shadow-sm">
                            Total unoccupied rooms <br>
                            <h3>@isset($Urooms){{$Urooms}}@endif</h3>
                        </div>
                        <div class="col-md-3 shadow-sm">
                          yet to pay total, expired <br>
                          <h3>@isset($unpaidRooms){{$unpaidRooms}}@endif</h3>
                        </div>
                        </section>
                        <section class="account-statement">
                          <h4 class="col-md-4 col-sm-12 pull-right text-center account">Account statement <br><br> <b>@isset($aStatement)${{$aStatement}}@endif</b></h4>
                        </section>
                      </div>
                      <section class="aparments-finance-wrapper col-md-12 my-3">
                        <h4>Apartments</h4>
                        @isset($apartments)
                        @foreach($apartments as $apartment)
                        <div class="col-md-3 apartment">
                            <h5><strong>{{$apartment->name}}</strong></h5><br>

                          <span class="highlight">Revenue 
                          @isset($apartment->tenants)
                          @php($revenue=array())
                          @foreach($apartment->tenants as $t)
                          @php($revenue[]=$t->room->price)
                          @php($trevenue=array_sum($revenue))
                          @endforeach
                          {{$trevenue}}
                          @endif
                        </span><br>

                          Total rooms <b>{{$apartment->rooms->count()}}</b><br>

                          Occupied rooms <b>{{$apartment->tenants->count()}}</b>
                          <a href="{{route('admin.rooms.show',$apartment->id)}}" role="button" class="btn btn-default btn-sm" name="button">show</a><br>
                          
                          Unoccupied rooms <b>_unknwn</b>
                          <a href="{{route('admin.rooms.show',$apartment->id)}}" role="button" class="btn btn-default btn-sm" name="button">show</a>
                        </div>
                        @endforeach
                        @endif
                      </section>
                    </div>
                  </div>
           </section>
     <!-- /.content -->
   </div>
@endsection
