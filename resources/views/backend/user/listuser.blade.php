@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" method="GET" action="{{ route('searchuser') }}">
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
                                    <h2 style="text-align: center;padding-bottom: 20px">List User </h2>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>
                                                    STT
                                                </th>
                                                <th style="text-align: center">
                                                    Name
                                                </th>
                                                <th style="text-align: center">Email</th>
                                                <th style="text-align: center">Email Verify At</th>
                                                <th style="text-align: center">Phone</th>
                                                <th style="text-align: center">Role</th>
                                                <th style="text-align: center">Created at</th>
                                                <th style="text-align: center">Update at</th>
                                                <th style="text-align: center">Service</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($user))
                                                @foreach ($user as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->email_verified_at }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->phone }}
                                                        </td>
                                                        <form
                                                            action="{{route('user.post-edit', ['id' => $item->id])}}"
                                                            method="POST">
                                                            @csrf
                                                            <td style="text-align: center">
                                                                <select
                                                                    style="width: 80px;text-align:center;background: #333;color: #ffffff"
                                                                    class="form-control bg-gray-600"
                                                                    name="role">
                                                                    <option
                                                                        value="admin" {{$item->role == "admin" ? "selected" : ""}}>
                                                                        Admin
                                                                    </option>
                                                                    <option
                                                                        value="user" {{$item->role == "user" ? "selected" : ""}}>
                                                                        User
                                                                    </option>
                                                                </select>
                                                            </td>
                                                            <td style="text-align: center">
                                                                {{ $item->created_at }}
                                                            </td>
                                                            <td style="text-align: center">
                                                                {{ $item->updated_at }}
                                                            </td>

                                                            <td>

                                                                <button type="submit"
                                                                        class="btn btn-success btn-sm"><i
                                                                        class="fas fa-edit"></i>Update
                                                                </button>
                                                        </form>

                                                        <a onclick="return confirm('Do you really want to delete?')"
                                                           href="{{ route('user.delete', ['id' => $item->id]) }}"
                                                           class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i>Delete</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12">Không có thông tin slide</td>
                                                </tr>

                                            @endif


                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="d-flex justify-content-end">
                                            {{ $user->links() }}
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
