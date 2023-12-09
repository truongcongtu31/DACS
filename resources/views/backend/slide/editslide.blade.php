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
                                    <h2 style="text-align: center">Edit Slide</h2>
                                    <p class="card-description">

                                    </p>

                                    @foreach ($slideDetail as $value)
                                        <form class="forms-sample"
                                              action="{{ route('slide.post-edit',['id'=>$value->id]) }}"
                                              enctype="multipart/form-data" method="POST">
                                            @csrf
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Slide</label>
                                                <input type="file" id="uploadslide" name="uploadslide"
                                                       class="form-control"
                                                       onchange="loadSlide(event)">
                                                <div class="image-show">
                                                    <img style="width: 180px" id="img_showslide"
                                                         src="{{$value->image}}">
                                                    <input type="hidden" name="slide" value="{{ $value->image }}">
                                                </div>

                                                @error('uploadslide')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>

                                            @endforeach
                                            <button type="submit" class="btn btn-primary ">Submit</button>

                                            <button class="btn btn-light" style="color: black"><a
                                                        style="text-decoration: none;"
                                                        href="{{ route('listslide') }}">Cancel</a>
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
