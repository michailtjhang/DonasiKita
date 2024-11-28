<div class="col-xxl-4 col-lg-5 text-dark">
    <aside class="sidebar-area">
        <div class="widget widget_search mb-2">
            <form class="search-form" action="/blogs">
                <div class="search-container align-items-center">
                    <div class="search-box">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari Artikel" autocomplete="off">
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
                    <p class="text-dark bolder-text">Related Posts</p>
                </div>
                <div class="col-sm-auto mt-2 fs-6 ">
                    <a style="text-decoration:#2185BB!important;" href="">See More</a>
                </div>
            </div>
            <div class="recent-post-wrap">
                <!-- Post 1 -->
                <div class="recent-post card mb-2 shadow rounded rounded-4">
                    <div class="row d-flex align-items-center">
                        <div class="media-img col-4">
                            <a href="">
                                <img class="img img-fluid rounded rounded-4" src="images/blog/post-1.svg"
                                    alt="Blog Image">
                            </a>
                        </div>
                        <div class="media-body col-8 px-4 justify-content-center">
                            <h4 class="post-title">
                                <a class="text-dark fs-5" href="">
                                    Bantuan untuk Korban Banjir di Jawa Barat
                                </a>
                            </h4>
                            <div class="recent-post-meta">
                                <p class="text-primary"> 10 Nov 24 | Bencana | Rina M</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post 2 -->
                <div class="recent-post card mb-2 shadow rounded rounded-4">
                    <div class="row d-flex align-items-center">
                        <div class="media-img col-4">
                            <a href="">
                                <img class="img img-fluid rounded rounded-4" src="images/blog/post-2.svg"
                                    alt="Blog Image">
                            </a>
                        </div>
                        <div class="media-body col-8 px-4 justify-content-center">
                            <h4 class="post-title">
                                <a class="text-dark fs-5" href="">
                                    Donasi untuk Gempa Lombok
                                </a>
                            </h4>
                            <div class="recent-post-meta">
                                <p class="text-primary"> 05 Nov 24 | Bencana | Andi. P</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post 3 -->
                <div class="recent-post card mb-2 shadow rounded rounded-4">
                    <div class="row d-flex align-items-center">
                        <div class="media-img col-4">
                            <a href="">
                                <img class="img img-fluid rounded rounded-4" src="images/blog/post-3.svg"
                                    alt="Blog Image">
                            </a>
                        </div>
                        <div class="media-body col-8 px-4 justify-content-center">
                            <h4 class="post-title">
                                <a class="text-dark fs-5" href="">
                                    Edukasi untuk Anak-Anak Terdampak
                                </a>
                            </h4>
                            <div class="recent-post-meta">
                                <p class="text-primary"> 02 Nov 24 | Edukasi | Siti A</p>
                            </div>
                        </div>
                    </div>
                </div>

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
