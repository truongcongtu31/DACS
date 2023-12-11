<!-- Modal -->
<div style="z-index: 99999; margin-top: 120px" class="modal fade" id="exampleModalCenter">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-body py-0">

                <div class="container">
                    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                            <img src="/images/icons/icon-close.png" alt="CLOSE">
                        </button>

                        <div class="row">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Product</th>
                                    <th class="column-2">Name</th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                @if(isset($orderDetail))
                                    @foreach($orderDetail as $key => $value)
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div>
                                                    <img src="{{$value->products->image}}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">{{$value->quantity}}</td>
                                            <td class="column-3">${{number_format($value->price)}}</td>
                                            <td class="column-4">
                                                {{number_format($value->quantity)}}
                                            </td>
                                            <td class="column-5">
                                                ${{number_format($value->price) * number_format($value->quantity)}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>




