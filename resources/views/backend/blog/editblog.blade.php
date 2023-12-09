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
                                    <h2 style="text-align: center">Edit Blog</h2>
                                    <p class="card-description">

                                    </p>
                                    @if($blogDetail)
                                        <form class="forms-sample"
                                              action="{{ route('blog.post-edit',['id'=>$blogDetail->id]) }} "
                                              method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="exampleInputName1">Title</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Title"
                                                       name="title" value="{{ old('title') ?? $blogDetail->title }}"/>
                                                @error('title')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1 ">Description</label>
                                                <textarea class="form-control" id="description"
                                                          placeholder="description"
                                                          name="description">
                       {{ old('description') ?? $blogDetail->description }} </textarea>
                                                @error('description')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Content</label>
                                                <textarea class="form-control" id="content" placeholder="Content"
                                                          name="content">
                                                    {{ old('content') ?? $blogDetail->content }} </textarea>
                                                @error('content')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Content 1</label>
                                                <textarea class="form-control" id="content1" placeholder="Content1"
                                                          name="content1">
                       {{ old('content1') ?? $blogDetail->content1 }} </textarea>
                                                @error('content1')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Blog</label>
                                                <input type="file" id="uploadblog" class="form-control"
                                                       onchange="loadBlog(event)">
                                                <div class="image-show">
                                                    <img id="img_showblog" style="width: 180px"
                                                         src="{{$blogDetail->image}}">
                                                    <input type="hidden" name="blog" id="hinhanhblog"
                                                           value="{{ $blogDetail->image }}">
                                                </div>
                                                <br>

                                                @error('uploadblog')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary ">Submit</button>

                                            <button class="btn btn-light" style="color: black"><a
                                                        style="text-decoration: none;"
                                                        href="{{ route('listblog') }}">Cancel</a>
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
