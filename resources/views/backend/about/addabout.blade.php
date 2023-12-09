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
                                    <h2 style="text-align: center">Add New About</h2>
                                    <p class="card-description right">
                                    </p>
                                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">Title</label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                   placeholder="Title" name="title"
                                                   value="{{ old('title') }}"/>
                                            @error('title')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Content</label>
                                            <textarea name="content" placeholder="Content" id="content" cols="1000"
                                                      rows="10">{{ old('content') }}</textarea>
                                            @error('content')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="form2Example2">Image About</label>
                                            <input type="file" id="uploadabout" name="uploadabout" class="form-control">
                                            <div class="image-show" id="img_showabout">
                                            </div>
                                            <input type="hidden" name="about" id="hinhanhabout">
                                            @error('uploadabout')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary ">Submit</button>
                                        <button class="btn btn-light"><a style="text-decoration: none;"
                                                                         href="{{ route('listabout') }}">Cancel</a>
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
@section('js-custom')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
