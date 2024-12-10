<div class="col-xxl-4 col-lg-5 text-dark">
    <aside class="sidebar-area">
        <div class="widget widget_search mb-2">
            <form action="{{ route('blog') }}">
                <div class="search-container align-items-center">
                    <div class="search-box">
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Cari Artikel"
                            autocomplete="off">
                        <button class="btn search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="widget content-spacer">
            <div class="row justify-content-between">
                <div class="col-sm-auto align-self-end fs-4">
                    <p class="text-dark bolder-text">Popular Articles</p>
                </div>
                <div class="col-sm-auto mt-2 fs-6 ">
                    <a style="text-decoration:#2185BB!important;" href="{{ route('blog') }}">See More</a>
                </div>
            </div>
            <div class="recent-post-wrap">
                <!-- Post 1 -->
                @foreach ($popular_articles as $item)
                    <div class="recent-post card mb-2 shadow rounded rounded-4">
                        <div class="row d-flex align-items-center">
                            <div class="media-img col-4">
                                <a href="">
                                    <img class="img img-fluid rounded rounded-4" src="{{ $item->thumbnail->file_path }}"
                                        alt="Blog Image">
                                </a>
                            </div>
                            <div class="media-body col-8 px-4 justify-content-center">
                                <h4 class="post-title">
                                    <a class="text-dark fs-5" href="{{ route('blog.show', $item->slug) }}">
                                        {{ $item->title }}
                                    </a>
                                </h4>
                                <div class="recent-post-meta">
                                    <p class="text-primary"> {{ $item->created_at->format('d M Y') }} |
                                        {{ $item->category->name }} | {{ $item->user->name ?? 'Anonim' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
        <div class="card rounded rounded-3 shadow justify-content-center px-3 py-3 widget">
            <p class="text-dark fs-4" style="margin-bottom: 2px;">Category</p>
            <hr class="w-100"
                style="height: 2px; border: none; background-color: #145071; opacity: 1; margin-top: 5px;">
            <div class="tagcloud">
                <ul style="list-style: none; padding-left: 0;">
                    @foreach ($categories as $item)
                        <li class="mb-3">
                            <a href="" class="bg-dark text-light btn">#{{ $item->slug }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </aside>
</div>
