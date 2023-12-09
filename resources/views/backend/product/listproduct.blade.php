@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" method="GET" action="{{ route('searchproduct') }}">
            <i class="icon-search"></i>
            <input type="search" class="form-control" name="search" id="search" placeholder="Search Here"
                   title="Search here">
        </form>
    </li>
@endsection
@section('content')
    <!-- partial -->
    <div class="main-panel">

        <div class="content-wrapper">
            @include('aleart')
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-tab">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h2 style="text-align: center">List Product</h2>
                                    <p class="card-description right">
                                        <a href="{{ route('addproduct') }}">
                                            <button class="btn btn-primary"
                                                    style="color: aliceblue">Add new product
                                            </button>
                                        </a>
                                    </p>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th style="text-align: center">
                                                    Image
                                                </th>
                                                <th style="text-align: center">
                                                    Image-1
                                                <th style="text-align: center">
                                                    Image-2
                                                </th>
                                                <th style="text-align: center">
                                                    Image-3
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th style="text-align: center">
                                                    Price
                                                </th>
                                                <th style="text-align: center">
                                                    Quantity
                                                </th>
                                                <th style="text-align: center">
                                                    Color
                                                </th>
                                                <th style="text-align: center">
                                                    Category_id
                                                </th>

                                                <th colspan="2" style="text-align: center">Service</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($product))
                                                @foreach ($product as $item)
                                                    <tr>
                                                        <td>
                                                            {{ $item->name }}
                                                        </td>
                                                        <td class="py-1">
                                                            <img src="{{ asset($item->image) }}"
                                                                 style="width: 80px; height: 100px; border-radius: 0%;">
                                                        </td>
                                                        <td class="py-1">
                                                            <img src="{{ asset($item->image_detail_1)  }}"
                                                                 style="width: 80px; height: 100px; border-radius: 0%;">
                                                        </td>
                                                        <td class="py-1">
                                                            <img src=" {{ asset($item->image_detail_2) }}"
                                                                 style="width: 80px; height: 100px; border-radius: 0%;">
                                                        </td>
                                                        <td class="py-1">
                                                            <img src="{{ asset($item->image_detail_3) }}"
                                                                 style="width: 80px; height: 100px; border-radius: 0%;">
                                                        </td>
                                                        <td style="max-width: 200px !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                                            {!! $item->description  !!}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ number_format($item->price, 0, '', '.') }} VNĐ
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->color }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->category_id }}
                                                        </td>
                                                        <td><a href="{{ route('product.edit', ['id' => $item->id]) }}"
                                                               class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i>Sửa</a>
                                                            <a onclick="return confirm('Are you sure you want to delete? ?')"
                                                               href="{{ route('product.delete', ['id' => $item->id]) }}"
                                                               class="btn btn-danger btn-sm"><i
                                                                    class="fas fa-trash"></i>Xóa</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12">Không có sản phẩm</td>
                                                </tr>

                                            @endif


                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="d-flex justify-content-end">
                                            {{ $product->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
                        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                    BootstrapDash.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights
                    reserved.</span>
            </div>
        </footer>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
@stop
