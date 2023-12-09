@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" action="#">
            <i class="icon-search"></i>
            <input type="search" class="form-control" placeholder="Search Here" title="Search here">
        </form>
    </li>

@endsection

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 style="text-align: center">Edit Banner</h2>
                                    <p class="card-description">

                                    </p>
                                    @foreach ($bannerDetail as $item)
                                        <form class="forms-sample"
                                              action="{{ route('banner.post-edit',['id'=>$item->id]) }} " method="post"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="exampleInputName1">Name</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Name"
                                                       name="name" value="{{ old('name') ?? $item->name }}"/>
                                                @error('name')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Event</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Event"
                                                       name="event" value="{{ old('event') ?? $item->event }}"/>
                                                @error('event')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Banner</label>
                                                <input type="file" id="uploadbanner" name="uploadbanner"
                                                       class="form-control"
                                                       onchange="loadBanner(event)">
                                                <div class="image-show pt-2">
                                                    <img style="width: 180px" id="img_showbanner"
                                                         src="{{$item->image}}">
                                                    <input type="hidden" name="banner" value="{{$item->image}}">
                                                </div>

                                                @error('uploadbanner')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            @endforeach
                                            <button type="submit" class="btn btn-primary text-white ">Submit</button>

                                            <button class="btn btn-light" style="color: black"><a
                                                        style="text-decoration: none;"
                                                        href="{{ route('listbanner') }}">Cancel</a>
                                            </button>

                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
