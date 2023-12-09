@foreach ($products as $key => $value)
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item bg-transparent">
        <!-- Block2 -->
        <div class="block2">
            <div class="block2-pic hov-img0">
                <img src="{{ $value['image'] }}" alt="IMG-PRODUCT">

                <a href="#" data-url="{{ route('product.show', $value->id) }}"
                   class="quick-view-btn block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                    Quick View
                </a>
            </div>

            <div class="block2-txt flex-w flex-t p-t-14">
                <div class="block2-txt-child1 flex-col-l ">
                    <a href="{{ route('product-detail',['id'=>$value['id']]) }}"
                       class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">{{ $value['name'] }}</a>

                    <span class="stext-105 cl3">{{ '$' . number_format($value['price']) }}</span>
                </div>

            </div>
        </div>
    </div>
@endforeach





