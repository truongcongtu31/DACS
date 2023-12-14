@extends('backend.master')
@section('search')
    <li class="nav-item">
        <form class="search-form" method="GET" action="{{ route('searchorder') }}">
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
                                    <h2 style="text-align: center;padding-bottom: 20px">List Order </h2>
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
                                                <th style="text-align: center">
                                                    Order date
                                                </th>
                                                <th style="text-align: center">
                                                    Received date
                                                </th>
                                                <th style="text-align: center">Phone</th>
                                                <th style="text-align: center">Address</th>
                                                <th style="text-align: center">Total</th>
                                                <th style="text-align: center">Pay Method</th>
                                                <th style="text-align: center">Status</th>
                                                <th style="text-align: center">Service</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if (!empty($order))
                                                @foreach ($order as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td>{{ $item->date }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->updated_at }}
                                                        </td>
                                                        <td>{{ $item->phone }}</td>
                                                        <td style="text-align: center">
                                                            {{ $item->address }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->total_price }}
                                                        </td>
                                                        <td style="text-align: center">
                                                            {{ $item->pay_method }}
                                                        </td>
                                                        <form
                                                            action="{{route('order.post-edit', ['id' => $item->id])}}"
                                                            method="POST">
                                                            @csrf
                                                            <td style="text-align: center">
                                                                <select
                                                                    style="width: 80px;background: #333;color: #ffffff"
                                                                    class="form-control bg-gray-600"
                                                                    name="role">
                                                                    <option
                                                                        value="received" {{$item->status == "received" ? "selected" : ""}}>
                                                                        received
                                                                    </option>
                                                                    <option
                                                                        value="not received" {{$item->status == "not received" ? "selected" : ""}}>
                                                                        not received
                                                                    </option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <button type="submit"
                                                                        class="btn btn-success btn-sm"><i
                                                                        class="fas fa-edit"></i>Update
                                                                </button>
                                                        </form>

                                                        <a onclick="return confirm('Do you really want to delete?')"
                                                           href="{{ route('order.delete', ['id' => $item->id]) }}"
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
                                            {{ $order->links() }}
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
