<div>
    @if($page)
        <div class="external-div">
            <div class="box-image-page">
                <div class="single-page-img"></div>
            </div>
            <div class="box-text">
                <h2>{{ $page->title }}</h2>
            </div>
        </div>

        <div id="tp_content">
            <div id="primary" class="content-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="entry-content" style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 2px 16px rgba(0,0,0,.06);">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="external-div">
            <div class="box-image-page">
                <div class="single-page-img"></div>
            </div>
            <div class="box-text">
                <h2>Halaman Tidak Ditemukan</h2>
            </div>
        </div>
        <div id="tp_content">
            <div id="primary" class="content-area">
                <div class="container text-center py-5">
                    <p style="font-size:1.1rem;color:#64748b;">Halaman yang Anda cari tidak ditemukan.</p>
                    <a href="{{ url('/') }}" class="mh-btn mh-btn--dark" style="display:inline-flex;margin-top:12px;">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    @endif
</div>
