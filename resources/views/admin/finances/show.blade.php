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
 height: 8rem;
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
.aparments-finance-wrapper{
  margin-top: 2em;
  background-color: #c9df8a;
}
.finances .apartment{
 height: 15em;
 margin: 1em;
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
                          <h4 class="col-md-4 shadow-sm text-center">Your current balances is <b>@isset($monthlyIncome)${{$monthlyIncome}} @endif</b></h4>
                          <h4 class="col-md-4 shadow-sm text-center">expected revenue <b>@isset($expectedIncome)${{$expectedIncome}} @endif</b></h4>
                          <h4 class="col-md-4 shadow-sm text-center">apartments maximum <b>$100000</b></h4>
                        </section>
                        <section class="assets text-center">
                          <div class="col-md-4 shadow-sm">
                            Occupied rooms total <br>
                            <h3>300</h3>
                          </div>
                        <div class="col-md-4 shadow-sm">
                            Total unoccupied rooms <br>
                            <h3>30</h3>
                        </div>
                        <div class="col-md-4 shadow-sm">
                          set to pay total expired <br>
                          <h3>30</h3>
                        </div>
                        </section>
                      </div>
                      <section class="aparments-finance-wrapper col-md-12 my-3">
                        <h4>Apartments</h4>
                        <div class="col-md-3 apartment">
                          <div class="apartment-subheading">
                            <h5><strong>Apartment &nbsp;<span class="highlight">Revenue 150,000</span></strong></h5>
                          </div>
                          Occupied rooms <b>100</b><br>
                          Occupied unpaid rooms <b>5</b> <button type="button" class="btn btn-default btn-sm" name="button">show</button><br>
                          Unoccupied rooms <b>5</b> <button type="button" class="btn btn-default btn-sm" name="button">show</button>
                        </div>
                      </section>
                    </div>
                  </div>
           </section>
     <!-- /.content -->
   </div>
@endsection
