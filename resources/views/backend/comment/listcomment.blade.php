@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" method="GET" action="{{ route('searchcomment') }}">
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
                                    <h2 style="text-align: center">List Comment </h2>
                                    <p class="card-description right">
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>
                                                    STT
                                                </th>
                                                <th>Name</th>
                                                <th style="width: 40%;height: 15%;">Email</th>
                                                <th style="width: 40%;height: 15%;">Content</th>
                                                <th style="width: 40%;height: 15%;">Blog-Id</th>
                                                <th style="text-align: center">Created_at</th>
                                                <th style="text-align: center">Updated_at</th>
                                                <th colspan="2" style="text-align: center">Service</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($comment))
                                                @foreach ($comment as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td style="max-width: 200px !important; overflow: hidden !important; text-overflow: ellipsis !important;">
                                                            {!! $item->email !!}
                                                        </td>
                                                        <td style="max-width: 200px !important; overflow: hidden !important; text-overflow: ellipsis !important;">{!! $item->content !!}
                                                        <td style="max-width: 200px !important; overflow: hidden !important; text-overflow: ellipsis !important;">{!! $item->blog->title !!}

                                                        <td style="text-align: center">
                                                            {{ $item->created_at }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->updated_at }}
                                                        </td>

                                                        <td>
                                                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa ?')"
                                                               href="{{ route('comment.delete', ['id' => $item->id]) }}"
                                                               class="btn btn-danger btn-sm"><i
                                                                    class="fas fa-trash"></i>Xóa</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12">Không có thông tin bình luận bài viết</td>
                                                </tr>

                                            @endif

                                            </tbody>
                                            {{$comment->links()}}
                                        </table>
                                        <br>

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
