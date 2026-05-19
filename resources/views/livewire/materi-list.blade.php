<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Materi Edukasi</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            @if($categories->count() > 0)
                <div class="materi-filters">
                    <button wire:click="filterByCategory('')" class="materi-filter-btn {{ $category === '' ? 'is-active' : '' }}">Semua</button>
                    @foreach($categories as $cat)
                        <button wire:click="filterByCategory('{{ $cat }}')" class="materi-filter-btn {{ $category === $cat ? 'is-active' : '' }}">{{ $cat }}</button>
                    @endforeach
                </div>
            @endif

            @if($materi->count() > 0)
                <div class="row g-4">
                    @foreach($materi as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="materi-card">
                                <div class="materi-card__header">
                                    <span class="materi-card__type materi-card__type--{{ $item->content_type }}">
                                        @switch($item->content_type)
                                            @case('pdf')
                                                <i class="fas fa-file-pdf"></i> PDF
                                                @break
                                            @case('link')
                                                <i class="fas fa-link"></i> Link
                                                @break
                                            @case('video')
                                                <i class="fas fa-video"></i> Video
                                                @break
                                            @default
                                                <i class="fas fa-file"></i> {{ ucfirst($item->content_type) }}
                                        @endswitch
                                    </span>
                                    @if($item->category)
                                        <span class="materi-card__category">{{ $item->category }}</span>
                                    @endif
                                </div>
                                <div class="materi-card__body">
                                    <h3 class="materi-card__title">{{ $item->title }}</h3>
                                    @if($item->description)
                                        <p class="materi-card__desc">{{ $item->description }}</p>
                                    @endif
                                </div>
                                <div class="materi-card__footer">
                                    @if($item->content_type === 'pdf' && $item->file_url)
                                        <a href="{{ $item->file_url }}" target="_blank" class="materi-card__btn">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    @elseif($item->content_type === 'link' && $item->link_url)
                                        <a href="{{ $item->link_url }}" target="_blank" class="materi-card__btn">
                                            <i class="fas fa-external-link-alt"></i> Buka Link
                                        </a>
                                    @elseif($item->file_url)
                                        <a href="{{ $item->file_url }}" target="_blank" class="materi-card__btn">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    @else
                                        <span class="materi-card__btn materi-card__btn--disabled">Tidak Tersedia</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-book-open" style="font-size:3rem;color:var(--color-primary1);opacity:.5;"></i>
                    <p class="mt-3" style="color:#6b7280;">Belum ada materi tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .materi-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
            justify-content: center;
        }
        .materi-filter-btn {
            padding: 8px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 100px;
            background: #fff;
            color: #4a5568;
            font-size: .84rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }
        .materi-filter-btn:hover {
            border-color: #1a9ed4;
            color: #1a9ed4;
        }
        .materi-filter-btn.is-active {
            background: #1a9ed4;
            border-color: #1a9ed4;
            color: #fff;
        }

        .materi-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #eef2f6;
            transition: all .3s;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .materi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(13,27,62,.08);
        }
        .materi-card__header {
            padding: 16px 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .materi-card__type {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .materi-card__type--pdf {
            background: #fee2e2;
            color: #db5f5f;
        }
        .materi-card__type--link {
            background: #dbeafe;
            color: #1a9ed4;
        }
        .materi-card__type--video {
            background: #d1fae5;
            color: #059669;
        }
        .materi-card__category {
            font-size: .72rem;
            font-weight: 600;
            color: #4ac6b9;
            background: rgba(74,198,185,.1);
            padding: 4px 10px;
            border-radius: 100px;
        }
        .materi-card__body {
            padding: 16px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .materi-card__title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #0d1b3e;
            margin: 0 0 8px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .materi-card__desc {
            font-size: .84rem;
            color: #6b7280;
            line-height: 1.6;
            margin: 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }
        .materi-card__footer {
            padding: 14px 20px;
            border-top: 1px solid #eef2f6;
        }
        .materi-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: var(--color-primary1);
            color: #fff !important;
            border-radius: 100px;
            font-size: .78rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: background .2s;
            width: 100%;
            justify-content: center;
        }
        .materi-card__btn:hover {
            background: var(--color-primary2);
            color: #fff !important;
        }
        .materi-card__btn--disabled {
            background: #e2e8f0;
            color: #94a3b8 !important;
            cursor: not-allowed;
        }
    </style>
</div>
