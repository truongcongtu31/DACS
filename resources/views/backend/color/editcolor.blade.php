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
                                    <h2 style="text-align: center">Edit Color Product</h2>

                                    <form class="forms-sample" action="{{ route('color.post-edit') }}" method="POST">
                                        @csrf
                                        @foreach ($colorDetail as $colorDetail)
                                            <div class="form-group">
                                                <label for="exampleInputName1">Name</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Name"
                                                       name="name" value="{{ old('name') ?? $colorDetail->name }}"/>
                                                @error('name')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Color-code</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Color-code"
                                                       name="color_code"
                                                       value="{{ old('color_code') ?? $colorDetail->color_code }}"/>
                                                @error('color_code')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                        @endforeach
                                        <button type="submit" class="btn btn-primary text-white">Submit</button>

                                        <button class="btn btn-light" style="color: black"><a
                                                style="text-decoration: none;"
                                                href="{{ route('listcolor') }}">Cancel</a></button>

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
