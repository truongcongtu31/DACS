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
                                    <h2 class="text-center">EDIT PRODUCT</h2>

                                    @if($productDetail)
                                        <form class="forms-sample"
                                              action="{{ route('product.post-edit',['id'=>$productDetail->id]) }} "
                                              method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputName1">Name</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                       placeholder="Name"
                                                       name="name" value="{{ old('name') ?? $productDetail->name }}"/>
                                                @error('name')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Product</label>
                                                <input data-id="0" type="file" name="upload_product"
                                                       class="form-control"
                                                       onchange="loadImage(event)">
                                                <div class="image-show">
                                                    <img style="width: 180px; padding: 20px" id="img_show_product_0"
                                                         src="{{$productDetail->image}}">
                                                    <input type="hidden" name="product"
                                                           value="{{$productDetail->image}}">
                                                </div>

                                                @error('upload_product')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Detail 1</label>
                                                <input data-id="1" type="file" name="upload_product1"
                                                       class="form-control"
                                                       onchange="loadImage(event)">
                                                <div class="image-show">
                                                    <img style="width: 180px; padding: 20px" id="img_show_product_1"
                                                         src="{{$productDetail->image_detail_1}}">
                                                    <input type="hidden" name="product_detail_1"
                                                           value="{{$productDetail->image_detail_1}}">
                                                </div>
                                                @error('upload_product1')
                                                <li style=" font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Detail 2</label>
                                                <input data-id="2" type="file" name="upload_product2"
                                                       class="form-control"
                                                       onchange="loadImage(event)">
                                                <div class="image-show">
                                                    <img style="width: 180px; padding: 20px" id="img_show_product_2"
                                                         src="{{$productDetail->image_detail_2}}">
                                                    <input type="hidden" name="product_detail_2"
                                                           value="{{$productDetail->image_detail_2}}">
                                                </div>
                                                @error('upload_product2')
                                                <li style=" font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form2Example2">Image Detail 3</label>
                                                <input data-id="3" type="file" name="upload_product3"
                                                       class="form-control"
                                                       onchange="loadImage(event)">
                                                <div class="image-show">
                                                    <img style="width: 180px; padding: 20px" id="img_show_product_3"
                                                         src="{{$productDetail->image_detail_3}}">
                                                    <input type="hidden" name="product_detail_3"
                                                           value="{{$productDetail->image_detail_3}}">
                                                </div>
                                                @error('upload_product3')
                                                <li style=" font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword4">Description</label>
                                                <textarea class="form-control" name="description" id="description"
                                                          cols="100"
                                                          rows="10">{{ old('description') ?? $productDetail->description }}</textarea>
                                                @error('description')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Price</label>
                                                <input type="text" class="form-control" placeholder="Price" name="price"
                                                       value="{{ old('price') ?? $productDetail->price }}"/>
                                                @error('price')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Quantity</label>
                                                <input type="text" class="form-control" placeholder="Quantity"
                                                       name="quantity"
                                                       value="{{ old('quantity') ?? $productDetail->quantity }}"/>
                                                @error('quantity')
                                                <li style="font-size: 12px;color: red ">{{ $message }}</li>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Tag</label>
                                                <select class="form-select" name="tag">
                                                    <option class="form-control"
                                                            value="man" {{$productDetail->tag == "man" ? 'selected' : ''}}>
                                                        Man
                                                    </option>
                                                    <option class="form-control"
                                                            value="woman" {{$productDetail->tag == "woman" ? 'selected' : ''}}>
                                                        Woman
                                                    </option>
                                                    <option class="form-control"
                                                            value="kid" {{$productDetail->tag == "kid" ? 'selected' : ''}}>
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
                                                <select class="form-select" name="category_id">
                                                    @foreach ($category as $item)
                                                        <option class="form-control"
                                                                {{ $productDetail->category_id == $item->id ? 'selected' : '' }}
                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary text-white">Submit</button>
                                            <button class="btn btn-light"><a style="text-decoration: none;"
                                                                             href="{{ route('listproduct') }}">Cancel</a>
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
            .create(document.querySelector('#description'), {

                autoParagraph: false,
            })
            .catch(error => {
                console.error(error);

            });
    </script>

@endsection
