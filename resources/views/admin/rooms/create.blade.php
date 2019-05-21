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
        <div class="box">
            <form action="{{route('admin.rooms.store')}}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                  <h2>add room</h2>
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="category">Select apartment<span class="text-danger">*</span></label>
                        <select name="apartment" id="apartment" class="form-control">
                            <?php if (auth('admin')->user()->isSuperAdmin()): ?>
                              <?php foreach ($apartments as $apartment): ?>
                                <option value="{{ $apartment->id }}">{{ $apartment->name }}</option>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <option value="{{ $apartments->id }}">{{ $apartments->name }}</option>
                            <?php endif; ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="roomnumber">Room Number<span class="text-danger">*</span></label>
                        <input type="text" name="roomnumber" id="number"  placeholder="room_number" class="form-control" value="{{ old('number')}}">
                    </div>

                     <div class="form-group">
                        <label for="type">Type </label>
                        <select name="type" id="status" class="form-control">
                            <option value="bedsitter">bedsitter</option>
                            <option value="1-bedroom">1-bedroom</option>
                           <option value="2-bedroom">2-bedroom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price<span class="text-danger">*</span></label>
                        <input type="text" name="price" id="price"  placeholder="price" class="form-control" value="{{ old('price')}}">
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.apartments.index') }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
