<section class="intro">
    <div class="bg-image h-100">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card shadow-2-strong">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">Order</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Date Receipt</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Method Pay</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($orders))
                                            @foreach ($orders as $key => $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    @if($item->status == "received" )
                                                        <td>{{ $item->updated_at }}</td>
                                                    @else
                                                        <td></td>
                                                    @endif
                                                    <td>${{$item->total_price }}</td>
                                                    <td>{{ $item->pay_method }}</td>

                                                    @if($item->status == "not received")
                                                        <td>
                                                            <form
                                                                action="{{route('order.status', ['id' => $item->id])}}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                        onclick="return confirm('The action cannot be undone. Are you sure?')"
                                                                        class="btn btn-secondary btn-sm"
                                                                        style="color: #cccccc"
                                                                        href="{{route('order.status',['id' => $item->id])}}">{{ $item->status }}
                                                                </button>
                                                            </form>
                                                        </td>

                                                        <td>
                                                            <form style="display: inline-block"
                                                                  action="{{route('order.delete', ['id' => $item->id])}}"
                                                                  method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                        onclick="return confirm('The action cannot be undone. Are you sure?')"
                                                                        href="{{ route('order.delete', ['id' => $item->id]) }}"
                                                                        class="btn btn-danger btn-sm">Cancel
                                                                </button>
                                                            </form>

                                                            <button data-id="{{$item->id}}" type="button"
                                                                    class="btn btn-primary btn-sm modal-detail-order">
                                                                Details
                                                            </button>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form
                                                                action="{{route('order.status', ['id' => $item->id])}}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit"
                                                                        class="btn btn-secondary btn-sm"
                                                                        style="color: #cccccc"
                                                                        href="{{route('order.status',['id' => $item->id])}}">{{ $item->status }}
                                                                </button>
                                                            </form>
                                                        </td>

                                                        <td>
                                                            <button disabled
                                                                    class="btn btn-danger btn-sm">Cancel
                                                            </button>

                                                            <button data-id="{{$item->id}}" type="button"
                                                                    class="btn btn-primary btn-sm modal-detail-order">
                                                                Details
                                                            </button>

                                                        </td>
                                                    @endif


                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->





