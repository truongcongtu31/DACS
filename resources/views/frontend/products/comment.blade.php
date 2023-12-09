@if(isset($comments))
    @foreach($comments as $key => $value)
        <div class="flex-w flex-t p-b-68">
            <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                <img src="images/avatar.png" alt="AVATAR">
            </div>

            <div class="size-207">
                <div class="flex-w flex-sb-m p-b-17">
            <span id="name-comment" class="mtext-107 cl2 p-r-20">
                {{$value->name}}
            </span>
                </div>

                <p id="content-comment" class="stext-102 cl6">
                    {{$value->content}}
                </p>
            </div>
        </div>
    @endforeach
    <div id="comment-pagination" class="row w-100 d-flex justify-content-center">
        {{ $comments->appends(request()->all())->links('frontend.pagination') }}
    </div>
@endif

