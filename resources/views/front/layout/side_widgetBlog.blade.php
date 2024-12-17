<div class="col-xxl-4 col-lg-5 text-dark">
    <aside class="sidebar-area">
        <div class="widget widget_search mb-4">
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
                    <a style="text-decoration:#2185BB!important;" href="{{ route('blog') }}">@lang('messages.see_more')</a>
                </div>
            </div>
            <div class="recent-post-wrap">
                @foreach ($popular_articles as $item)
                    <div class="recent-post card mb-2 shadow rounded rounded-4">
                        <div class="row d-flex align-items-center">
                            <div class="media-img col-4" style="height: 180px; line-height: 0; flex: 0 0 auto; min-height: 180px;"> <!-- Atur tinggi -->
                                <a href="">
                                    <img class="img img-fluid rounded rounded-4"
                                         style="object-fit: cover; width: 100%; height: 100%;"
                                         src="{{ $item->thumbnail->file_path }}"
                                         alt="Blog Image">
                                </a>
                            </div>
                            <div class="media-body col-8 d-flex flex-column justify-content-center px-4">
                                <h4 class="post-title">
                                    <a class="text-dark fs-5" href="{{ route('blog.show', $item->slug) }}">
                                        {{ $item->title }}
                                        {{ Str::limit(strip_tags($item->title), 4, '...') }}
                                    </a>
                                </h4>
                                <div class="recent-post-meta">
                                    <p class="text-primary" style="font-size-adjust: 10pt;">
                                        <span><i class="fas fa-clock"></i> {{ $item->created_at->format('d M Y') }} </span><br>
                                        <span><i class="fas fa-grip-horizontal"></i> {{ $item->category->name }} </span><br>
                                        <span><i class="fas fa-user"></i> {{ $item->user->name ?? 'Anonim' }} </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="card rounded rounded-3 shadow justify-content-center px-3 py-3 widget">
            <p class="text-dark fs-4" style="margin-bottom: 2px;">All Category</p>
            <hr class="w-100"
                style="height: 2px; border: none; background-color: #145071; opacity: 1; margin-top: 5px;">
            <div class="tagcloud">
                    @foreach ($categories as $item)
                            <a href="" class="bg-dark text-light btn me-2 mb-2">#{{ $item->slug }}</a>
                    @endforeach
            </div>
        </div>
    </aside>
</div>
