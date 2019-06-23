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
            <form action="{{ route('admin.rooms.update', $room['id']) }}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="col-md-8">
                            <h3>edit room-{{ ucfirst($room->room_no) }}</h3>
                            <div class="form-group">
                                <label for="name">Room No. <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{!! $room->room_no ?: old('room_no')  !!}">
                            </div>
                            <div class="form-group">
                                <label for="type">Type </label>
                                <select name="type" id="type" class="form-control">
                                    <option value="bedsitter" @if($room->type == 'bedsitter') selected="selected" @endif>bedsitter</option>
                                    <option value="1-bedroom" @if($room->type == '1-bedroom') selected="selected" @endif>1 bedroom</option>
                                    <option value="2-bedroom" @if($room->type == '2-bedroom') selected="selected" @endif>2 bedroom</option>
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="price">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon">Price</span>
                                    <input type="text" name="price" id="price" placeholder="Price" class="form-control" value="{!! $room->price ?: old('price')  !!}">
                                </div>
                            </div>
                            <div class="row"></div>
                            <div class="form-group">
                                @if(isset($images))
                                @foreach($images as $image)
                                    <div class="col-md-3">
                                        <div class="row">
                                            <img src="{{ asset("storage/$image->source") }}" alt="" class="img-responsive"> <br />
                                            <a onclick="return confirm('Are you sure?')" href="{{ route('admin.rooms.remove.thumb', ['source' => $image->source]) }}" class="btn btn-danger btn-sm btn-block">Remove?</a><br />
                                        </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="row"></div>
                            <div class="form-group">
                                <label for="image">Images </label>
                                <input type="file" name="image[]" id="image" class="form-control" multiple>
                                <span class="text-warning">You can use ctrl (cmd) to select multiple images</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <h3>apartment</h3>
                            <h4>{{$room->apartment->name}}</h4>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ URL:: previous() }}" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
