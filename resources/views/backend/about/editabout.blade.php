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
                                    <h2 style="text-align: center">Edit About</h2>
                                    <p class="card-description">

                                    </p>
                                    @if ($aboutDetail)
                                        <form class="forms-sample"
                                            action="{{ route('about.post-edit', ['id' => $aboutDetail->id]) }} "
                                            method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="exampleInputName1">Title</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                    placeholder="Title" name="title"
                                                    value="{{ old('title') ?? $aboutDetail->title }}" />
                                                @error('title')
                                                    <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputName1">Content</label>
                                                <textarea class="form-control" id="content" placeholder="Content" name="content">
                                                    {{ old('content') ?? $aboutDetail->content }} </textarea>
                                                @error('content')
                                                    <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image About</label>
                                                <input type="file" id="uploadabout" name="uploadabout" class="form-control"
                                                    onchange="loadAbout(event)">
                                                <div class="image-show">
                                                    <img id="img_showabout" style="width: 180px"
                                                        src="{{ $aboutDetail->image }}">
                                                    <input type="hidden" name="about" id="hinhanhabout"
                                                        value="{{ $aboutDetail->image }}">
                                                </div>
                                                <br>

                                                @error('uploadabout')
                                                    <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary ">Submit</button>

                                            <button class="btn btn-light" style="color: black"><a
                                                    style="text-decoration: none;"
                                                    href="{{ route('listabout') }}">Cancel</a>
                                            </button>

                                        </form>
                                    @endif
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
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#content1'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
