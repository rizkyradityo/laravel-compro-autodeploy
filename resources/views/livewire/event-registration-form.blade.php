<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Pendaftaran Event</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="reg-wrapper">
                <div class="reg-main">
                    @if($step === 3 && $registration)
                        <div class="reg-card reg-card--success">
                            <div class="text-center py-4">
                                <div class="reg-success-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 class="reg-success-title">Pendaftaran Berhasil!</h3>
                                <p class="reg-success-desc">
                                    Terima kasih <strong>{{ $registration->name }}</strong>, pendaftaran Anda untuk event
                                    <strong>{{ $registration->event->title ?? '#' }}</strong> telah diterima.
                                </p>
                                <div class="reg-success-info">
                                    <div class="reg-success-info__item">
                                        <span class="reg-success-info__label">Order ID</span>
                                        <span class="reg-success-info__value">{{ $registration->order_id }}</span>
                                    </div>
                                    <div class="reg-success-info__item">
                                        <span class="reg-success-info__label">Status Pembayaran</span>
                                        <span class="reg-success-info__value">
                                            @if($registration->payment_status === 'paid')
                                                <span class="reg-badge reg-badge--success">Lunas</span>
                                            @elseif($registration->payment_status === 'pending_qris')
                                                <span class="reg-badge reg-badge--warning">Menunggu Verifikasi</span>
                                            @else
                                                <span class="reg-badge reg-badge--warning">Menunggu Pembayaran</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="reg-success-info__item">
                                        <span class="reg-success-info__label">Total</span>
                                        <span class="reg-success-info__value reg-success-info__value--price">{{ $registration->amount > 0 ? 'Rp ' . number_format($registration->amount, 0, ',', '.') : 'Gratis' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('events.landing') }}" class="reg-btn reg-btn--primary mt-4 d-inline-flex">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Events
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="reg-card">
                            <div class="reg-progress">
                                <div class="reg-progress__bar">
                                    <div class="reg-progress__fill" style="width: {{ ($step / 3) * 100 }}%"></div>
                                </div>
                                <div class="reg-progress__steps">
                                    <div class="reg-progress__step {{ $step >= 1 ? 'is-active' : '' }} {{ $step > 1 ? 'is-done' : '' }}">
                                        <div class="reg-progress__circle">
                                            @if($step > 1)
                                                <i class="fas fa-check"></i>
                                            @else
                                                1
                                            @endif
                                        </div>
                                        <span class="reg-progress__label">Detail</span>
                                    </div>
                                    <div class="reg-progress__step {{ $step >= 2 ? 'is-active' : '' }} {{ $step > 2 ? 'is-done' : '' }}">
                                        <div class="reg-progress__circle">
                                            @if($step > 2)
                                                <i class="fas fa-check"></i>
                                            @else
                                                2
                                            @endif
                                        </div>
                                        <span class="reg-progress__label">Pembayaran</span>
                                    </div>
                                    <div class="reg-progress__step {{ $step >= 3 ? 'is-active' : '' }}">
                                        <div class="reg-progress__circle">3</div>
                                        <span class="reg-progress__label">Konfirmasi</span>
                                    </div>
                                </div>
                            </div>

                            <form wire:submit.prevent="nextStep">
                                @if($step === 1)
                                    <div class="reg-step">
                                        <h4 class="reg-step__title">Detail Pendaftaran</h4>
                                        <p class="reg-step__desc">Lengkapi data diri Anda untuk mendaftar event.</p>

                                        <div class="mb-3">
                                            <label class="reg-label">Pilih Event <span class="text-danger">*</span></label>
                                            <select wire:model="event_id" class="reg-input">
                                                <option value="">-- Pilih Event --</option>
                                                @foreach($events as $ev)
                                                    <option value="{{ $ev->id }}" data-price="{{ $ev->price }}">
                                                        {{ $ev->title }} - {{ $ev->event_date->format('d M Y') }} ({{ $ev->price_formatted }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('event_id') <span class="reg-error">{{ $message }}</span> @enderror
                                        </div>

                                        @if($this->selectedEvent)
                                            <div class="reg-price-box">
                                                <div class="reg-price-box__label">Biaya Pendaftaran</div>
                                                <div class="reg-price-box__value">{{ $this->selectedEvent->price_formatted }}</div>
                                                @if($this->selectedEvent->price > 0)
                                                    <div class="reg-price-box__info">Pembayaran dapat dilakukan melalui metode yang tersedia di langkah berikutnya.</div>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="reg-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" wire:model="name" class="reg-input" placeholder="Nama lengkap Anda">
                                            @error('name') <span class="reg-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="reg-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" wire:model="email" class="reg-input" placeholder="contoh@email.com">
                                                    @error('email') <span class="reg-error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="reg-label">Nomor Telepon <span class="text-danger">*</span></label>
                                                    <input type="tel" wire:model="phone" class="reg-input" placeholder="08xxxxxxxxxx">
                                                    @error('phone') <span class="reg-error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($step === 2)
                                    <div class="reg-step">
                                        <h4 class="reg-step__title">Pembayaran</h4>
                                        <p class="reg-step__desc">Pilih metode pembayaran yang tersedia.</p>

                                        @if($this->selectedEvent && $this->selectedEvent->price > 0)
                                            <div class="reg-summary mb-4">
                                                <div class="reg-summary__row">
                                                    <span>Event</span>
                                                    <span>{{ $this->selectedEvent->title }}</span>
                                                </div>
                                                <div class="reg-summary__row">
                                                    <span>Nama</span>
                                                    <span>{{ $name }}</span>
                                                </div>
                                                <div class="reg-summary__row">
                                                    <span>Email</span>
                                                    <span>{{ $email }}</span>
                                                </div>
                                                <div class="reg-summary__row reg-summary__row--total">
                                                    <span>Total Pembayaran</span>
                                                    <span>{{ $this->selectedEvent->price_formatted }}</span>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="reg-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                                <div class="reg-payment-options">
                                                    <label class="reg-payment-option {{ $payment_method === 'midtrans' ? 'is-selected' : '' }}">
                                                        <input type="radio" wire:model="payment_method" value="midtrans" class="d-none">
                                                        <div class="reg-payment-option__content">
                                                            <div class="reg-payment-option__icon" style="background:rgba(26,158,212,.12);color:#1a9ed4;">
                                                                <i class="fas fa-credit-card"></i>
                                                            </div>
                                                            <div>
                                                                <div class="reg-payment-option__title">Midtrans</div>
                                                                <div class="reg-payment-option__desc">Pembayaran via Virtual Account, Kartu Kredit, atau metode lainnya</div>
                                                            </div>
                                                            <div class="reg-payment-option__check">
                                                                <i class="fas fa-check-circle"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    <label class="reg-payment-option {{ $payment_method === 'qris' ? 'is-selected' : '' }}">
                                                        <input type="radio" wire:model="payment_method" value="qris" class="d-none">
                                                        <div class="reg-payment-option__content">
                                                            <div class="reg-payment-option__icon" style="background:rgba(74,198,185,.12);color:#4ac6b9;">
                                                                <i class="fas fa-qrcode"></i>
                                                            </div>
                                                            <div>
                                                                <div class="reg-payment-option__title">QRIS</div>
                                                                <div class="reg-payment-option__desc">Scan QR code dan upload bukti pembayaran</div>
                                                            </div>
                                                            <div class="reg-payment-option__check">
                                                                <i class="fas fa-check-circle"></i>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                @error('payment_method') <span class="reg-error">{{ $message }}</span> @enderror
                                            </div>

                                            @if($payment_method === 'qris')
                                                <div class="reg-qris-section">
                                                    <div class="reg-qris-section__header">
                                                        <i class="fas fa-qrcode"></i>
                                                        <span>Pembayaran QRIS</span>
                                                    </div>
                                                    <p class="reg-qris-section__desc">
                                                        Silakan transfer sebesar <strong>{{ $this->selectedEvent->price_formatted }}</strong> ke QRIS berikut, lalu upload bukti pembayaran.
                                                    </p>
                                                    <div class="reg-qris-section__qris">
                                                        <img src="{{ asset('images/qris-placeholder.png') }}" alt="QRIS Code" style="width:180px;height:180px;object-fit:contain;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="reg-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                                                        <div class="reg-file-upload">
                                                            <input type="file" wire:model="proof_image" accept="image/*" id="proofInput">
                                                            <label for="proofInput" class="reg-file-upload__label">
                                                                <i class="fas fa-cloud-upload-alt"></i>
                                                                <span>{{ $proof_image ? $proof_image->getClientOriginalName() : 'Pilih file gambar' }}</span>
                                                            </label>
                                                        </div>
                                                        @error('proof_image') <span class="reg-error">{{ $message }}</span> @enderror
                                                        <small class="reg-hint">Format: JPG, PNG. Maksimal 2MB.</small>
                                                    </div>
                                                    @if($proof_image)
                                                        <div class="reg-preview">
                                                            <img src="{{ $proof_image->temporaryUrl() }}" alt="Preview">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @else
                                            <div class="reg-free-notice">
                                                <i class="fas fa-gift"></i>
                                                <div>
                                                    <strong>Event Gratis!</strong>
                                                    <p class="mb-0">Pendaftaran event ini tidak dikenakan biaya. Silakan lanjutkan untuk menyelesaikan pendaftaran.</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="reg-actions">
                                    @if($step > 1)
                                        <button type="button" wire:click="prevStep" class="reg-btn reg-btn--outline">
                                            <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                        </button>
                                    @endif
                                    <button type="submit" class="reg-btn reg-btn--primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="nextStep" class="me-2">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                        @if($step === 1)
                                            Lanjut ke Pembayaran <i class="fas fa-arrow-right ms-2"></i>
                                        @elseif($step === 2)
                                            @if($this->selectedEvent && $this->selectedEvent->price > 0)
                                                {{ $payment_method === 'midtrans' ? 'Bayar via Midtrans' : 'Kirim & Daftar' }}
                                            @else
                                                Daftar Gratis <i class="fas fa-check ms-2"></i>
                                            @endif
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="reg-sidebar">
                    <div class="reg-sidebar-card">
                        <div class="reg-sidebar-card__header">
                            <i class="fas fa-info-circle"></i>
                            Informasi Pendaftaran
                        </div>
                        <div class="reg-sidebar-card__body">
                            <ul class="reg-sidebar-list">
                                <li>Pilih event yang ingin diikuti</li>
                                <li>Lengkapi data diri Anda</li>
                                <li>Pilih metode pembayaran yang tersedia</li>
                                <li>Lakukan pembayaran sesuai nominal</li>
                                <li>Upload bukti pembayaran (jika via QRIS)</li>
                                <li>Tunggu konfirmasi dari tim kami</li>
                            </ul>
                        </div>
                    </div>

                    @if($this->selectedEvent)
                        <div class="reg-sidebar-card">
                            <div class="reg-sidebar-card__header" style="background:var(--color-primary1);">
                                <i class="fas fa-calendar-alt"></i>
                                Detail Event
                            </div>
                            <div class="reg-sidebar-card__body">
                                @if($this->selectedEvent->thumb_url)
                                    <img src="{{ $this->selectedEvent->thumb_url }}" alt="{{ $this->selectedEvent->title }}"
                                         style="width:100%;height:140px;object-fit:cover;border-radius:10px;margin-bottom:14px;">
                                @endif
                                <h5 style="font-family:'Josefin Sans',sans-serif;font-weight:700;color:#0d1b3e;font-size:1rem;margin:0 0 10px;">
                                    {{ $this->selectedEvent->title }}
                                </h5>
                                <div class="reg-sidebar-meta">
                                    <span><i class="far fa-calendar"></i> {{ $this->selectedEvent->event_date->format('d M Y') }}</span>
                                    @if($this->selectedEvent->event_time)
                                        <span><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($this->selectedEvent->event_time)->format('H:i') }} WIB</span>
                                    @endif
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $this->selectedEvent->location }}</span>
                                    <span><i class="fas fa-tag"></i> {{ $this->selectedEvent->price_formatted }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="reg-sidebar-card">
                        <div class="reg-sidebar-card__header" style="background:#db5f5f;">
                            <i class="fas fa-headset"></i>
                            Butuh Bantuan?
                        </div>
                        <div class="reg-sidebar-card__body">
                            <p style="font-size:.85rem;color:#6b7280;margin:0 0 8px;">
                                Hubungi kami jika mengalami kendala pendaftaran:
                            </p>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                               style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#25D366;color:#fff;border-radius:100px;font-size:.85rem;font-weight:600;text-decoration:none;">
                                <i class="fab fa-whatsapp"></i> +62 812-3456-7890
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .reg-wrapper {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 32px;
            align-items: start;
        }
        .reg-main {
            min-width: 0;
        }
        .reg-card {
            background: #fff;
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 0 2px #aaa;
            border-bottom: 3px solid var(--color-primary1);
        }
        .reg-card--success {
            border-bottom-color: #4ac6b9;
        }

        .reg-progress {
            margin-bottom: 32px;
        }
        .reg-progress__bar {
            height: 4px;
            background: #eef2f6;
            border-radius: 4px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .reg-progress__fill {
            height: 100%;
            background: linear-gradient(90deg, #4ac6b9, #1a9ed4);
            border-radius: 4px;
            transition: width .4s ease;
        }
        .reg-progress__steps {
            display: flex;
            justify-content: space-between;
        }
        .reg-progress__step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        .reg-progress__circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .82rem;
            font-weight: 700;
            background: #eef2f6;
            color: #9ca3af;
            transition: all .3s;
            border: 2px solid transparent;
        }
        .reg-progress__step.is-active .reg-progress__circle {
            background: var(--color-primary1);
            color: #fff;
            border-color: var(--color-primary1);
        }
        .reg-progress__step.is-done .reg-progress__circle {
            background: #4ac6b9;
            color: #fff;
            border-color: #4ac6b9;
        }
        .reg-progress__label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #9ca3af;
        }
        .reg-progress__step.is-active .reg-progress__label,
        .reg-progress__step.is-done .reg-progress__label {
            color: #0d1b3e;
        }

        .reg-step__title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0d1b3e !important;
            margin: 0 0 6px;
        }
        .reg-step__desc {
            font-size: .88rem;
            color: #6b7280;
            margin: 0 0 24px;
        }

        .reg-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: #0d1b3e;
            margin-bottom: 6px;
        }
        .reg-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: .9rem;
            color: #333;
            transition: border-color .2s;
            background: #fff;
        }
        .reg-input:focus {
            outline: none;
            border-color: var(--color-primary1);
            box-shadow: 0 0 0 3px rgba(74,198,185,.1);
        }
        .reg-error {
            display: block;
            font-size: .78rem;
            color: #db5f5f;
            margin-top: 4px;
        }
        .reg-hint {
            font-size: .78rem;
            color: #9ca3af;
            margin-top: 4px;
            display: block;
        }

        .reg-price-box {
            background: linear-gradient(135deg, rgba(74,198,185,.08), rgba(26,158,212,.08));
            border: 1px solid rgba(74,198,185,.2);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .reg-price-box__label {
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .reg-price-box__value {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: #db5f5f;
        }
        .reg-price-box__info {
            font-size: .78rem;
            color: #6b7280;
            margin-top: 6px;
        }

        .reg-summary {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px 20px;
            border: 1px solid #eef2f6;
        }
        .reg-summary__row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: .88rem;
            color: #6b7280;
            border-bottom: 1px solid #eef2f6;
        }
        .reg-summary__row:last-child {
            border-bottom: none;
        }
        .reg-summary__row--total {
            font-weight: 700;
            color: #0d1b3e;
            font-size: 1rem;
            padding-top: 12px;
            border-top: 2px solid #d1d5db;
            margin-top: 4px;
        }

        .reg-payment-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .reg-payment-option {
            cursor: pointer;
        }
        .reg-payment-option__content {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            border: 1.5px solid #d1d5db;
            border-radius: 12px;
            transition: all .2s;
        }
        .reg-payment-option.is-selected .reg-payment-option__content {
            border-color: var(--color-primary1);
            background: rgba(74,198,185,.05);
        }
        .reg-payment-option__icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .reg-payment-option__title {
            font-weight: 600;
            color: #0d1b3e;
            font-size: .9rem;
        }
        .reg-payment-option__desc {
            font-size: .78rem;
            color: #6b7280;
            margin-top: 2px;
        }
        .reg-payment-option__check {
            margin-left: auto;
            color: #d1d5db;
            font-size: 1.3rem;
        }
        .reg-payment-option.is-selected .reg-payment-option__check {
            color: #4ac6b9;
        }

        .reg-qris-section {
            background: #f8fafc;
            border: 1px solid #eef2f6;
            border-radius: 12px;
            padding: 20px;
            margin-top: 4px;
        }
        .reg-qris-section__header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: #0d1b3e;
            font-size: .95rem;
            margin-bottom: 10px;
        }
        .reg-qris-section__header i {
            font-size: 1.2rem;
            color: var(--color-primary1);
        }
        .reg-qris-section__desc {
            font-size: .85rem;
            color: #6b7280;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .reg-qris-section__qris {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
            padding: 16px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #eef2f6;
        }

        .reg-file-upload input[type="file"] {
            display: none;
        }
        .reg-file-upload__label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            cursor: pointer;
            font-size: .88rem;
            color: #6b7280;
            transition: all .2s;
        }
        .reg-file-upload__label:hover {
            border-color: var(--color-primary1);
            color: var(--color-primary1);
        }
        .reg-file-upload__label i {
            font-size: 1.3rem;
        }

        .reg-preview {
            margin-top: 12px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eef2f6;
        }
        .reg-preview img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            background: #f8fafc;
        }

        .reg-free-notice {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px 20px;
            background: rgba(74,198,185,.1);
            border: 1px solid rgba(74,198,185,.2);
            border-radius: 12px;
            color: #0d1b3e;
            font-size: .88rem;
            line-height: 1.6;
        }
        .reg-free-notice i {
            font-size: 1.5rem;
            color: #4ac6b9;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .reg-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #eef2f6;
        }
        .reg-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 28px;
            border-radius: 100px;
            font-size: .88rem;
            font-weight: 600;
            text-decoration: none !important;
            transition: all .25s;
            border: none;
            cursor: pointer;
        }
        .reg-btn--primary {
            background: #1a9ed4;
            color: #fff !important;
        }
        .reg-btn--primary:hover {
            background: #1480b0;
            color: #fff !important;
        }
        .reg-btn--outline {
            background: transparent;
            color: #6b7280;
            border: 1.5px solid #d1d5db;
        }
        .reg-btn--outline:hover {
            border-color: #1a9ed4;
            color: #1a9ed4;
        }

        .reg-success-icon {
            font-size: 4rem;
            color: #4ac6b9;
            margin-bottom: 16px;
        }
        .reg-success-title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d1b3e !important;
            margin: 0 0 10px;
        }
        .reg-success-desc {
            font-size: .9rem;
            color: #6b7280;
            max-width: 440px;
            margin: 0 auto 24px;
            line-height: 1.6;
        }
        .reg-success-info {
            display: flex;
            flex-direction: column;
            gap: 0;
            max-width: 400px;
            margin: 0 auto;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #eef2f6;
            overflow: hidden;
        }
        .reg-success-info__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid #eef2f6;
        }
        .reg-success-info__item:last-child {
            border-bottom: none;
        }
        .reg-success-info__label {
            font-size: .82rem;
            color: #6b7280;
        }
        .reg-success-info__value {
            font-size: .85rem;
            font-weight: 600;
            color: #0d1b3e;
        }
        .reg-success-info__value--price {
            color: #db5f5f;
            font-size: 1rem;
        }

        .reg-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
        }
        .reg-badge--success {
            background: rgba(74,198,185,.15);
            color: #4ac6b9;
        }
        .reg-badge--warning {
            background: rgba(255,159,67,.15);
            color: #ff9f43;
        }

        .reg-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .reg-sidebar-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 2px #aaa;
            border-bottom: 3px solid var(--color-primary1);
        }
        .reg-sidebar-card__header {
            background: #0d1b3e;
            color: #fff;
            padding: 14px 18px;
            font-weight: 600;
            font-size: .88rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .reg-sidebar-card__body {
            padding: 18px;
        }
        .reg-sidebar-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .reg-sidebar-list li {
            position: relative;
            padding: 6px 0 6px 20px;
            font-size: .84rem;
            color: #6b7280;
            line-height: 1.5;
        }
        .reg-sidebar-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 13px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--color-primary1);
        }
        .reg-sidebar-meta {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .reg-sidebar-meta span {
            font-size: .82rem;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .reg-sidebar-meta i {
            width: 14px;
            color: var(--color-primary1);
        }

        @media (max-width: 992px) {
            .reg-wrapper {
                grid-template-columns: 1fr;
            }
            .reg-sidebar {
                order: -1;
            }
        }
        @media (max-width: 576px) {
            .reg-card {
                padding: 24px 18px;
            }
            .reg-actions {
                flex-direction: column;
            }
            .reg-actions .reg-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</div>
