@if ($paginator->hasPages())

    <div class="pagination-box">
        <ul class="pagination">
            @if ($paginator->onFirstPage())

                <li class="page-item">
                    <a class="page-link"><span class="fa fa-chevron-left"></span></a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span
                            class="fa fa-chevron-left"></span></a>
                </li>

            @endif
            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- Array Of Links -->

                @foreach ($element as $page => $url)
                    {{-- {{ dd($page, $url) }} --}}
                    <!--  Use three dots when current page is greater than 4.  -->
                    @if ($paginator->currentPage() > 4 && $page === 2)
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                    @endif

                    <!--  Show active page else show the first and last two pages from current page.  -->
                    @if ($page == $paginator->currentPage())

                        <li class="page-item active"><a class="active"
                                href="{{ $url }}">{{ $page }}</a><span class="sr-only">(current)</span>
                        </li>

                    @elseif ($page === $paginator->currentPage() + 1 || $page === $paginator->currentPage()
                        + 2
                        || $page ===
                        $paginator->currentPage() - 1 || $page === $paginator->currentPage() - 2 || $page ===
                        $paginator->lastPage()
                        || $page === 1)
                        <li class="page-item ">
                            <a class="page-link" href="{{ $url }}">{{ $page }} </a>
                        </li>
                    @endif

                    <!--  Use three dots when current page is away from end.  -->
                    @if ($paginator->currentPage() < $paginator->lastPage() - 3 && $page === $paginator->lastPage() - 1)
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                    @endif
                @endforeach
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><span
                            class="fa fa-chevron-right"></span></a>
                </li>

            @else
                <li class="page-item">
                    <a class="page-link"><span class="fa fa-chevron-right"></span></a>
                </li>
            @endif

        </ul>
    </div>

@endif
