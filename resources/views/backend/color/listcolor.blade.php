@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" method="GET" action="{{ route('searchcolor') }}">
            <i class="icon-search"></i>
            <input type="search" class="form-control" name="search" placeholder="Search Here" title="Search here">
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
                                    <h2 style="text-align: center">List Color Product</h2>
                                    <p class="card-description right">
                                        <a href="{{ route('addcolor') }}">
                                            <button class="btn btn-primary"
                                                    style="color: aliceblue">Add new color
                                            </button>
                                        </a>


                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>
                                                    STT
                                                </th>
                                                <th>
                                                    Name
                                                </th>
                                                <th>Color-code</th>
                                                <th style="text-align: center">
                                                    Created_at
                                                </th>
                                                <th style="text-align: center">
                                                    Updated_at
                                                </th>
                                                <th colspan="2" style="text-align: center">Service</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($color))
                                                @foreach ($color as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            {{ $item->name }}
                                                        </td>

                                                        <td>
                                                            {{ $item->color_code }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->updated_at }}
                                                        </td>

                                                        <td style="text-align: center"><a
                                                                href="{{ route('color.edit', ['id' => $item->id]) }}"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="fas fa-edit"></i>Sửa</a>
                                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa ?')"
                                                               href="{{ route('color.delete', ['id' => $item->id]) }}"
                                                               class="btn btn-danger btn-sm"><i
                                                                    class="fas fa-trash"></i>Xóa</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12">Không có màu sắc sản phẩm</td>
                                                </tr>

                                            @endif


                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="d-flex justify-content-end">
                                            {{ $color->links() }}
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
