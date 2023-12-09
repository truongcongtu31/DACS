@foreach($feedback ?? null as $key => $value )
    <div class="flex-w flex-t p-b-68">
        <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
            <img src="images/avatar.png" alt="AVATAR">
        </div>

        <div class="size-207">
            <div class="flex-w flex-sb-m p-b-17">
                <span class="mtext-107 cl2 p-r-20">
                    {{$value->name}}
                </span>

                <span class="fs-18 cl11">
                    @for($i = 1 ; $i <= $value->star ; $i++)
                        <i class="zmdi zmdi-star"></i>
                    @endfor
                    @for($i = 1 ; $i <= (5 - $value->star) ; $i++)
                        <i class="zmdi zmdi-star-outline"></i>
                    @endfor
                </span>
            </div>

            <p class="stext-102 cl6">
                {{$value->content}}
            </p>
        </div>
    </div>
@endforeach
<div id="feedback-pagination" class="row w-100 d-flex justify-content-center">
    {{ $feedback->appends(request()->all())->links('frontend.pagination') }}
</div>


