@if ($paginator->hasPages())
    <div class="row mt-5 d-flex">
        <div class="col text-center">
            <div class="block-27">
                <ul class="d-flex justify-content-center">
                    @if ($paginator->onFirstPage())
                        <li><a class="disabled" aria-disabled="true">&lt;</a></li>
                    @else
                        <li><a href="{{ $paginator->previousPageUrl() }}">&lt;</a></li>
                    @endif
                    @foreach ($elements as $element )
                        @if(is_string($element))
                            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url )
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach


                    @if ($paginator->onLastPage())
                        <li><a class="disabled" aria-disabled="true">&gt;</a></li>
                    @else
                        <li><a href="{{ $paginator->nextPageUrl() }}">&gt;</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif



