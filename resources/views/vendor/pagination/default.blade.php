@if ($paginator->hasPages())
    <div class="pagination col-md-4 " style="display: flex;justify-content: right; margin: 0; padding: 0;">

        {{-- Pre Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="btn btn-primary btn_paginate btn-disabled"><span>前へ</span></a>
        @else
            <a class="btn btn-primary btn_paginate btn-active" href="{{ $paginator->previousPageUrl() }}" rel="prev">前へ</a>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="" ><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="page active" ><span>{{ $page }}</span></a>
                    @else
                        <a class="" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-primary btn_paginate btn-active" href="{{ $paginator->nextPageUrl() }}" rel="next">次へ</a>
        @else
            <a href="#" class="btn btn-primary btn_paginate btn-disabled"><span>次へ</span></a>
        @endif
    </div>
@endif

