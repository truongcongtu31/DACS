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

                <div class="col-sm-12 pb-4">
                    <div class="statistics-details d-flex align-items-center justify-content-between"
                         style="border-top: groove;border-bottom: groove;padding: 10px 0">
                        <div>
                            <p class="statistics-title">Total Order</p>
                            <h3 class="rate-percentage">{{$data['orders']}}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p>
                        </div>
                        <div class="d-none d-md-block">
                            <p class="statistics-title">Total revenue</p>
                            <h3 class="rate-percentage">${{$data['total']}}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                        </div>
                        <div>
                            <p class="statistics-title">Total Product</p>
                            <h3 class="rate-percentage">{{$data['products']}}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p>
                        </div>
                        <div>
                            <p class="statistics-title">Total User</p>
                            <h3 class="rate-percentage">{{$data['users']}}</h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                        </div>
                        <div class="d-none d-md-block">
                            <p class="statistics-title">Total Feedback</p>
                            <h3 class="rate-percentage">{{$data['feedbacks']}}</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">YEARLY INCOME</h4>
                            <canvas id="yearChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">MONTHLY INCOME</h4>
                            <canvas id="areaChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">TOP BUYER</h4>
                            <div class="card-body">

                                <div class="mt-3">
                                    @forelse($topBuyer as $top)
                                        <div
                                            class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                            <div class="d-flex">
                                                <img class="img-sm rounded-10" src="images/avt.jpg"
                                                     alt="profile">
                                                <div class="wrapper ms-3">
                                                    <p class="ms-1 mb-1 fw-bold">{{$top->user->name}}</p>
                                                    <small class="text-muted mb-0">${{$top->total}}</small>
                                                </div>
                                            </div>
                                            <div class="text-muted text-small">
                                                Count: {{$top->count_order}}
                                            </div>
                                        </div>
                                    @empty
                                        <p>No data</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--//TOP--}}

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx_month = document.getElementById('areaChart');
            new Chart(ctx_month, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($allMonths) !!},
                    datasets: [{
                        label: 'Dollar',
                        data: {!! json_encode($totalByMonth) !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <script>
            const ctx_year = document.getElementById('yearChart');
            new Chart(ctx_year, {
                type: 'line',
                data: {
                    labels: {!! json_encode($years) !!},
                    datasets: [{
                        label: 'Dollar',
                        fill: false,
                        data: {!! json_encode($totalByYear) !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
@stop
