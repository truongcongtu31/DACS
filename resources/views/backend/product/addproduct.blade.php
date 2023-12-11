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
                                    <h2 style="text-align: center">ADD NEW PRODUCT</h2>
                                    <p class="card-description">
                                    </p>
                                    <form class="forms-sample" enctype="multipart/form-data" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputName1">Name</label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                   placeholder="Name"
                                                   name="name"
                                                   value="{{ old('name') }}"/>
                                            @error('name')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="form2Example2">Image Product</label>
                                            <input data-id="0" type="file" id="upload_product" name="upload_product"
                                                   class="form-control"
                                                   onchange="loadImage(event)">
                                            <div class="image-show">
                                                <img style="width: 180px;padding: 20px" id="img_show_product_0"
                                                     class="d-none">
                                            </div>
                                            @error('upload_product')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="form2Example2">Image Product Detail 1 </label>
                                            <input data-id="1" type="file" id="upload_product1"
                                                   name="upload_product1"
                                                   class="form-control"
                                                   onchange="loadImage(event)">
                                            <div class="image-show">
                                                <img style="width: 180px;padding: 20px" id="img_show_product_1"
                                                     class="d-none">
                                            </div>
                                            @error('upload_product1')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="form2Example2">Image Product Detail 2</label>
                                            <input data-id="2" type="file" id="upload_product2"
                                                   name="upload_product2"
                                                   class="form-control"
                                                   onchange="loadImage(event)">
                                            <div class="image-show">
                                                <img style="width: 180px;padding: 20px" id="img_show_product_2"
                                                     class="d-none">
                                            </div>
                                            @error('upload_product2')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="form2Example2">Image Product Detail 3</label>
                                            <input data-id="3" type="file" id="upload_product3"
                                                   name="upload_product3"
                                                   class="form-control"
                                                   onchange="loadImage(event)">
                                            <div class="image-show">
                                                <img style="width: 180px;padding: 20px" id="img_show_product_3"
                                                     class="d-none">
                                            </div>
                                            @error('upload_product3')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword4">Description</label>
                                            <textarea name="description" id="description" cols="1000"
                                                      rows="10">{{ old('description') }}</textarea>
                                            @error('description')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Price</label>
                                            <input type="text" class="form-control" placeholder="Price" name="price"
                                                   value="{{ old('price') }}">
                                            @error('price')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Quantity</label>
                                            <input type="text" class="form-control" placeholder="Quantity"
                                                   name="quantity"
                                                   value="{{ old('quantity') }}">
                                            @error('quantity')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Tag</label>
                                            <select class="form-select" name="tag">
                                                <option class="form-control" value="man">
                                                    Man
                                                </option>
                                                <option class="form-control" value="woman">
                                                    Woman
                                                </option>
                                                <option class="form-control" value="kid">
                                                    Kid
                                                </option>
                                            </select>
                                            @error('tag')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Color</label>
                                            <select class="form-select" name="color">
                                                @foreach ($colors as $item)
                                                    <option class="form-control" value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('color')
                                            <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectGender">Category</label>
                                            <select class="form-select" class="category_id" name="category_id">
                                                @foreach ($categories as $item)
                                                    <option class="form-control" value="{{ $item->id }}">
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <button type="submit" class="btn btn-primary text-white">Submit</button>
                                        <button class="btn btn-light"><a style="text-decoration: none;"
                                                                         href="{{ route('listproduct') }}">Cancel</a>
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
            .create(document.querySelector('#description'), {
                autoParagraph: false,
            })
            .catch(error => {
                console.error(error);

            });
    </script>

@endsection
