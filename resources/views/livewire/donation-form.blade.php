<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Donasi</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">

            @if($step === 3 && $success)
                <div class="don-wrapper">
                    <div class="don-main">
                        <div class="don-card don-card--success">
                            <div class="text-center py-4">
                                <div class="don-success-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 class="don-success-title">Donasi Berhasil!</h3>
                                <p class="don-success-desc">
                                    Terima kasih <strong>{{ $name }}</strong>, donasi Anda sebesar
                                    <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong> telah tercatat.
                                    Silakan selesaikan pembayaran sesuai petunjuk di bawah.
                                </p>
                                <div class="don-success-info">
                                    <div class="don-success-info__item">
                                        <span class="don-success-info__label">Order ID</span>
                                        <span class="don-success-info__value">{{ $order_id }}</span>
                                    </div>
                                    <div class="don-success-info__item">
                                        <span class="don-success-info__label">Nama</span>
                                        <span class="don-success-info__value">{{ $name }}</span>
                                    </div>
                                    <div class="don-success-info__item">
                                        <span class="don-success-info__label">Email</span>
                                        <span class="don-success-info__value">{{ $email }}</span>
                                    </div>
                                    <div class="don-success-info__item">
                                        <span class="don-success-info__label">Status</span>
                                        <span class="don-success-info__value">
                                            @if($payment_method === 'qris')
                                                <span class="don-badge don-badge--warning">Menunggu Verifikasi</span>
                                            @else
                                                <span class="don-badge don-badge--warning">Menunggu Pembayaran</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="don-success-info__item">
                                        <span class="don-success-info__label">Nominal</span>
                                        <span class="don-success-info__value don-success-info__value--price">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                @if($payment_method === 'qris')
                                    <div class="don-success-payment mt-4">
                                        <h5><i class="fas fa-qrcode me-2" style="color:var(--color-primary1);"></i>Pembayaran QRIS</h5>
                                        <p style="color:#6b7280;font-size:.88rem;margin-bottom:16px;">
                                            Silakan scan QR code berikut untuk melakukan pembayaran sebesar
                                            <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong>
                                        </p>
                                        <div class="don-success-qris">
                                            <img src="{{ asset('images/qris-placeholder.png') }}" alt="QRIS Code">
                                        </div>
                                        <p style="color:#9ca3af;font-size:.78rem;margin-top:12px;">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Bukti pembayaran telah diupload dan akan diverifikasi oleh tim kami.
                                        </p>
                                    </div>
                                @else
                                    <div class="don-success-midtrans mt-4">
                                        <h5><i class="fas fa-credit-card me-2" style="color:var(--color-primary1);"></i>Pembayaran Midtrans</h5>
                                        <p style="color:#6b7280;font-size:.88rem;">
                                            Kami akan mengirimkan instruksi pembayaran ke email <strong>{{ $email }}</strong>.
                                            Silakan cek email Anda untuk menyelesaikan pembayaran.
                                        </p>
                                    </div>
                                @endif

                                <a href="{{ url('/') }}" class="don-btn don-btn--primary mt-4 d-inline-flex">
                                    <i class="fas fa-home me-2"></i> Kembali ke Beranda
                                </a>
                                <a href="{{ url()->current() }}" class="don-btn don-btn--outline mt-4 ms-2 d-inline-flex">
                                    <i class="fas fa-redo me-2"></i> Donasi Lagi
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="don-sidebar">
                        <div class="don-sidebar-card">
                            <div class="don-sidebar-card__header" style="background:#0d1b3e;">
                                <i class="fas fa-check-circle"></i>
                                Donasi Berhasil
                            </div>
                            <div class="don-sidebar-card__body">
                                <p style="font-size:.85rem;color:#6b7280;margin:0 0 12px;">
                                    Langkah selanjutnya:
                                </p>
                                <ul class="don-sidebar-list">
                                    <li>Catat Order ID Anda: <strong>{{ $order_id }}</strong></li>
                                    @if($payment_method === 'qris')
                                        <li>Scan QR code dan lakukan pembayaran</li>
                                        <li>Tunggu verifikasi bukti bayar (1x24 jam)</li>
                                    @else
                                        <li>Cek email Anda untuk instruksi pembayaran</li>
                                        <li>Selesaikan pembayaran melalui metode yang dipilih</li>
                                    @endif
                                    <li>Konfirmasi akan dikirim via email</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="don-wrapper">
                    <div class="don-main">
                        <div class="don-card">
                            <div class="don-progress">
                                <div class="don-progress__bar">
                                    <div class="don-progress__fill" style="width: {{ ($step / 3) * 100 }}%"></div>
                                </div>
                                <div class="don-progress__steps">
                                    <div class="don-progress__step {{ $step >= 1 ? 'is-active' : '' }} {{ $step > 1 ? 'is-done' : '' }}">
                                        <div class="don-progress__circle">
                                            @if($step > 1)
                                                <i class="fas fa-check"></i>
                                            @else
                                                1
                                            @endif
                                        </div>
                                        <span class="don-progress__label">Data Diri</span>
                                    </div>
                                    <div class="don-progress__step {{ $step >= 2 ? 'is-active' : '' }} {{ $step > 2 ? 'is-done' : '' }}">
                                        <div class="don-progress__circle">
                                            @if($step > 2)
                                                <i class="fas fa-check"></i>
                                            @else
                                                2
                                            @endif
                                        </div>
                                        <span class="don-progress__label">Pembayaran</span>
                                    </div>
                                    <div class="don-progress__step {{ $step >= 3 ? 'is-active' : '' }}">
                                        <div class="don-progress__circle">3</div>
                                        <span class="don-progress__label">Selesai</span>
                                    </div>
                                </div>
                            </div>

                            <form wire:submit.prevent="submit">
                                @if($step === 1)
                                    <div class="don-step">
                                        <h4 class="don-step__title">Data Diri</h4>
                                        <p class="don-step__desc">Lengkapi data diri Anda untuk melakukan donasi.</p>

                                        <div class="mb-3">
                                            <label class="don-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" wire:model="name" class="don-input" placeholder="Nama lengkap Anda">
                                            @error('name') <span class="don-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="don-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" wire:model="email" class="don-input" placeholder="contoh@email.com">
                                                    @error('email') <span class="don-error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="don-label">Nomor Telepon <span class="text-danger">*</span></label>
                                                    <input type="tel" wire:model="phone" class="don-input" placeholder="08xxxxxxxxxx">
                                                    @error('phone') <span class="don-error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="don-label">Jumlah Donasi <span class="text-danger">*</span></label>
                                            <div class="don-amount-presets">
                                                <button type="button" class="don-amount-btn {{ $amount == 10000 ? 'is-selected' : '' }}" wire:click="setAmount(10000)">
                                                    Rp10.000
                                                </button>
                                                <button type="button" class="don-amount-btn {{ $amount == 25000 ? 'is-selected' : '' }}" wire:click="setAmount(25000)">
                                                    Rp25.000
                                                </button>
                                                <button type="button" class="don-amount-btn {{ $amount == 50000 ? 'is-selected' : '' }}" wire:click="setAmount(50000)">
                                                    Rp50.000
                                                </button>
                                                <button type="button" class="don-amount-btn {{ $amount == 100000 ? 'is-selected' : '' }}" wire:click="setAmount(100000)">
                                                    Rp100.000
                                                </button>
                                            </div>
                                            <div class="don-custom-amount mt-2">
                                                <div class="don-input-group">
                                                    <span class="don-input-group__text">Rp</span>
                                                    <input type="number" wire:model="amount" class="don-input don-input--no-round-left" placeholder="Jumlah lainnya" min="1000">
                                                </div>
                                            </div>
                                            @error('amount') <span class="don-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="don-live-preview">
                                            <div class="don-live-preview__label">Ringkasan Donasi</div>
                                            <div class="don-live-preview__amount">
                                                Rp {{ $amount ? number_format($amount, 0, ',', '.') : '0' }}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="don-label">Pesan (Opsional)</label>
                                            <textarea wire:model="message" class="don-input" rows="3" placeholder="Tulis pesan atau doa..." maxlength="500"></textarea>
                                            @error('message') <span class="don-error">{{ $message }}</span> @enderror
                                            <small class="don-hint">Maksimal 500 karakter. {{ $message ? strlen($message) : 0 }}/500</small>
                                        </div>
                                    </div>
                                @elseif($step === 2)
                                    <div class="don-step">
                                        <h4 class="don-step__title">Pembayaran</h4>
                                        <p class="don-step__desc">Pilih metode pembayaran yang tersedia.</p>

                                        <div class="don-summary mb-4">
                                            <div class="don-summary__row">
                                                <span>Nama</span>
                                                <span>{{ $name }}</span>
                                            </div>
                                            <div class="don-summary__row">
                                                <span>Email</span>
                                                <span>{{ $email }}</span>
                                            </div>
                                            <div class="don-summary__row">
                                                <span>Telepon</span>
                                                <span>{{ $phone }}</span>
                                            </div>
                                            @if($message)
                                                <div class="don-summary__row">
                                                    <span>Pesan</span>
                                                    <span>{{ \Illuminate\Support\Str::limit($message, 30) }}</span>
                                                </div>
                                            @endif
                                            <div class="don-summary__row don-summary__row--total">
                                                <span>Total Donasi</span>
                                                <span>Rp {{ number_format($amount, 0, ',', '.') }}</span>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="don-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                            <div class="don-payment-options">
                                                <label class="don-payment-option {{ $payment_method === 'midtrans' ? 'is-selected' : '' }}">
                                                    <input type="radio" wire:model="payment_method" value="midtrans" class="d-none">
                                                    <div class="don-payment-option__content">
                                                        <div class="don-payment-option__icon" style="background:rgba(26,158,212,.12);color:#1a9ed4;">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <div>
                                                            <div class="don-payment-option__title">Midtrans</div>
                                                            <div class="don-payment-option__desc">Virtual Account, Kartu Kredit, ATM, Mobile Banking</div>
                                                        </div>
                                                        <div class="don-payment-option__check">
                                                            <i class="fas fa-check-circle"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <label class="don-payment-option {{ $payment_method === 'qris' ? 'is-selected' : '' }}">
                                                    <input type="radio" wire:model="payment_method" value="qris" class="d-none">
                                                    <div class="don-payment-option__content">
                                                        <div class="don-payment-option__icon" style="background:rgba(74,198,185,.12);color:#4ac6b9;">
                                                            <i class="fas fa-qrcode"></i>
                                                        </div>
                                                        <div>
                                                            <div class="don-payment-option__title">QRIS</div>
                                                            <div class="don-payment-option__desc">Scan QR dan upload bukti pembayaran</div>
                                                        </div>
                                                        <div class="don-payment-option__check">
                                                            <i class="fas fa-check-circle"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            @error('payment_method') <span class="don-error">{{ $message }}</span> @enderror
                                        </div>

                                        @if($payment_method === 'qris')
                                            <div class="don-qris-section">
                                                <div class="don-qris-section__header">
                                                    <i class="fas fa-qrcode"></i>
                                                    <span>Pembayaran QRIS</span>
                                                </div>
                                                <p class="don-qris-section__desc">
                                                    Transfer sebesar <strong>Rp {{ number_format($amount, 0, ',', '.') }}</strong> ke QRIS berikut,
                                                    lalu upload bukti pembayaran.
                                                </p>
                                                <div class="don-qris-section__qris">
                                                    <img src="{{ asset('images/qris-placeholder.png') }}" alt="QRIS Code" style="width:180px;height:180px;object-fit:contain;">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="don-label">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                                                    <div class="don-file-upload">
                                                        <input type="file" wire:model="proof_image" accept="image/*" id="proofInput">
                                                        <label for="proofInput" class="don-file-upload__label">
                                                            <i class="fas fa-cloud-upload-alt"></i>
                                                            <span>{{ $proof_image ? $proof_image->getClientOriginalName() : 'Pilih file gambar' }}</span>
                                                        </label>
                                                    </div>
                                                    @error('proof_image') <span class="don-error">{{ $message }}</span> @enderror
                                                    <small class="don-hint">Format: JPG, PNG. Maksimal 5MB.</small>
                                                </div>
                                                @if($proof_image)
                                                    <div class="don-preview">
                                                        <img src="{{ $proof_image->temporaryUrl() }}" alt="Preview">
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="don-actions">
                                    @if($step > 1)
                                        <button type="button" wire:click="$set('step', {{ $step - 1 }})" class="don-btn don-btn--outline">
                                            <i class="fas fa-arrow-left me-2"></i> Sebelumnya
                                        </button>
                                    @endif
                                    <button type="submit" class="don-btn don-btn--primary" wire:loading.attr="disabled">
                                        <span wire:loading wire:target="submit" class="me-2">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                        @if($step === 1)
                                            Lanjut ke Pembayaran <i class="fas fa-arrow-right ms-2"></i>
                                        @elseif($step === 2)
                                            @if($payment_method === 'midtrans')
                                                Donasi via Midtrans <i class="fas fa-credit-card ms-2"></i>
                                            @else
                                                Kirim Donasi <i class="fas fa-check ms-2"></i>
                                            @endif
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="don-sidebar">
                        <div class="don-sidebar-card">
                            <div class="don-sidebar-card__header">
                                <i class="fas fa-info-circle"></i>
                                Cara Donasi
                            </div>
                            <div class="don-sidebar-card__body">
                                <ul class="don-sidebar-list">
                                    <li>Lengkapi data diri Anda</li>
                                    <li>Tentukan jumlah donasi</li>
                                    <li>Tulis pesan atau doa (opsional)</li>
                                    <li>Pilih metode pembayaran</li>
                                    <li>Lakukan pembayaran sesuai nominal</li>
                                    <li>Upload bukti pembayaran (jika via QRIS)</li>
                                    <li>Tunggu konfirmasi dari tim kami</li>
                                </ul>
                            </div>
                        </div>

                        <div class="don-sidebar-card">
                            <div class="don-sidebar-card__header" style="background:var(--color-primary1);">
                                <i class="fas fa-shield-alt"></i>
                                Aman & Terpercaya
                            </div>
                            <div class="don-sidebar-card__body">
                                <p style="font-size:.84rem;color:#6b7280;margin:0 0 12px;line-height:1.7;">
                                    Donasi Anda aman bersama kami. Data pribadi Anda dilindungi dan tidak akan disalahgunakan.
                                </p>
                                <div class="don-security-items">
                                    <div class="don-security-item">
                                        <i class="fas fa-lock"></i>
                                        <span>Data terenkripsi</span>
                                    </div>
                                    <div class="don-security-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Verifikasi manual</span>
                                    </div>
                                    <div class="don-security-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>Konfirmasi email</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="don-sidebar-card">
                            <div class="don-sidebar-card__header" style="background:#db5f5f;">
                                <i class="fas fa-credit-card"></i>
                                Metode Pembayaran
                            </div>
                            <div class="don-sidebar-card__body">
                                <div class="don-payment-methods">
                                    <div class="don-payment-method">
                                        <div class="don-payment-method__icon" style="color:#1a9ed4;">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <div class="don-payment-method__name">Virtual Account</div>
                                            <div class="don-payment-method__desc">BCA, Mandiri, BNI, BRI</div>
                                        </div>
                                    </div>
                                    <div class="don-payment-method">
                                        <div class="don-payment-method__icon" style="color:#4ac6b9;">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div>
                                            <div class="don-payment-method__name">Mobile Banking</div>
                                            <div class="don-payment-method__desc">GoPay, OVO, Dana, ShopeePay</div>
                                        </div>
                                    </div>
                                    <div class="don-payment-method">
                                        <div class="don-payment-method__icon" style="color:#db5f5f;">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <div>
                                            <div class="don-payment-method__name">Kartu Kredit</div>
                                            <div class="don-payment-method__desc">Visa, Mastercard, JCB</div>
                                        </div>
                                    </div>
                                    <div class="don-payment-method">
                                        <div class="don-payment-method__icon" style="color:#1a9ed4;">
                                            <i class="fas fa-qrcode"></i>
                                        </div>
                                        <div>
                                            <div class="don-payment-method__name">QRIS</div>
                                            <div class="don-payment-method__desc">Semua aplikasi pembayaran</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="don-sidebar-card">
                            <div class="don-sidebar-card__header" style="background:#0d1b3e;">
                                <i class="fas fa-headset"></i>
                                Butuh Bantuan?
                            </div>
                            <div class="don-sidebar-card__body">
                                <p style="font-size:.85rem;color:#6b7280;margin:0 0 10px;">
                                    Hubungi kami jika mengalami kendala:
                                </p>
                                <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"
                                   style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#25D366;color:#fff;border-radius:100px;font-size:.85rem;font-weight:600;text-decoration:none;">
                                    <i class="fab fa-whatsapp"></i> +62 812-3456-7890
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <style>
        .don-wrapper {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 32px;
            align-items: start;
        }
        .don-main {
            min-width: 0;
        }
        .don-card {
            background: #fff;
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 0 2px #aaa;
            border-bottom: 3px solid var(--color-primary1);
        }
        .don-card--success {
            border-bottom-color: #4ac6b9;
        }

        .don-progress {
            margin-bottom: 32px;
        }
        .don-progress__bar {
            height: 4px;
            background: #eef2f6;
            border-radius: 4px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .don-progress__fill {
            height: 100%;
            background: linear-gradient(90deg, #4ac6b9, #1a9ed4);
            border-radius: 4px;
            transition: width .4s ease;
        }
        .don-progress__steps {
            display: flex;
            justify-content: space-between;
        }
        .don-progress__step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        .don-progress__circle {
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
        .don-progress__step.is-active .don-progress__circle {
            background: var(--color-primary1);
            color: #fff;
            border-color: var(--color-primary1);
        }
        .don-progress__step.is-done .don-progress__circle {
            background: #4ac6b9;
            color: #fff;
            border-color: #4ac6b9;
        }
        .don-progress__label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #9ca3af;
        }
        .don-progress__step.is-active .don-progress__label,
        .don-progress__step.is-done .don-progress__label {
            color: #0d1b3e;
        }

        .don-step__title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0d1b3e !important;
            margin: 0 0 6px;
        }
        .don-step__desc {
            font-size: .88rem;
            color: #6b7280;
            margin: 0 0 24px;
        }

        .don-label {
            display: block;
            font-size: .85rem;
            font-weight: 600;
            color: #0d1b3e;
            margin-bottom: 6px;
        }
        .don-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: .9rem;
            color: #333;
            transition: border-color .2s;
            background: #fff;
        }
        .don-input:focus {
            outline: none;
            border-color: var(--color-primary1);
            box-shadow: 0 0 0 3px rgba(74,198,185,.1);
        }
        .don-input--no-round-left {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .don-error {
            display: block;
            font-size: .78rem;
            color: #db5f5f;
            margin-top: 4px;
        }
        .don-hint {
            font-size: .78rem;
            color: #9ca3af;
            margin-top: 4px;
            display: block;
        }

        .don-amount-presets {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .don-amount-btn {
            padding: 10px 22px;
            border: 1.5px solid #d1d5db;
            border-radius: 100px;
            background: #fff;
            font-size: .85rem;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all .2s;
        }
        .don-amount-btn:hover {
            border-color: var(--color-primary1);
            color: var(--color-primary1);
        }
        .don-amount-btn.is-selected {
            background: var(--color-primary1);
            border-color: var(--color-primary1);
            color: #fff;
        }

        .don-input-group {
            display: flex;
            align-items: stretch;
        }
        .don-input-group__text {
            display: flex;
            align-items: center;
            padding: 0 14px;
            background: #f3f4f6;
            border: 1.5px solid #d1d5db;
            border-right: none;
            border-radius: 10px 0 0 10px;
            font-weight: 700;
            color: #6b7280;
            font-size: .9rem;
        }

        .don-live-preview {
            background: linear-gradient(135deg, rgba(74,198,185,.08), rgba(26,158,212,.08));
            border: 1px solid rgba(74,198,185,.2);
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .don-live-preview__label {
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            margin-bottom: 4px;
        }
        .don-live-preview__amount {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 800;
            color: #db5f5f;
        }

        .don-summary {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px 20px;
            border: 1px solid #eef2f6;
        }
        .don-summary__row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: .88rem;
            color: #6b7280;
            border-bottom: 1px solid #eef2f6;
        }
        .don-summary__row:last-child {
            border-bottom: none;
        }
        .don-summary__row--total {
            font-weight: 700;
            color: #0d1b3e;
            font-size: 1rem;
            padding-top: 12px;
            border-top: 2px solid #d1d5db;
            margin-top: 4px;
        }

        .don-payment-options {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .don-payment-option {
            cursor: pointer;
        }
        .don-payment-option__content {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
            border: 1.5px solid #d1d5db;
            border-radius: 12px;
            transition: all .2s;
        }
        .don-payment-option.is-selected .don-payment-option__content {
            border-color: var(--color-primary1);
            background: rgba(74,198,185,.05);
        }
        .don-payment-option__icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .don-payment-option__title {
            font-weight: 600;
            color: #0d1b3e;
            font-size: .9rem;
        }
        .don-payment-option__desc {
            font-size: .78rem;
            color: #6b7280;
            margin-top: 2px;
        }
        .don-payment-option__check {
            margin-left: auto;
            color: #d1d5db;
            font-size: 1.3rem;
        }
        .don-payment-option.is-selected .don-payment-option__check {
            color: #4ac6b9;
        }

        .don-qris-section {
            background: #f8fafc;
            border: 1px solid #eef2f6;
            border-radius: 12px;
            padding: 20px;
            margin-top: 4px;
        }
        .don-qris-section__header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: #0d1b3e;
            font-size: .95rem;
            margin-bottom: 10px;
        }
        .don-qris-section__header i {
            font-size: 1.2rem;
            color: var(--color-primary1);
        }
        .don-qris-section__desc {
            font-size: .85rem;
            color: #6b7280;
            margin-bottom: 16px;
            line-height: 1.6;
        }
        .don-qris-section__qris {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
            padding: 16px;
            background: #fff;
            border-radius: 12px;
            border: 1px solid #eef2f6;
        }

        .don-file-upload input[type="file"] {
            display: none;
        }
        .don-file-upload__label {
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
        .don-file-upload__label:hover {
            border-color: var(--color-primary1);
            color: var(--color-primary1);
        }
        .don-file-upload__label i {
            font-size: 1.3rem;
        }

        .don-preview {
            margin-top: 12px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #eef2f6;
        }
        .don-preview img {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            background: #f8fafc;
        }

        .don-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #eef2f6;
        }
        .don-btn {
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
        .don-btn--primary {
            background: #1a9ed4;
            color: #fff !important;
        }
        .don-btn--primary:hover {
            background: #1480b0;
            color: #fff !important;
        }
        .don-btn--outline {
            background: transparent;
            color: #6b7280;
            border: 1.5px solid #d1d5db;
        }
        .don-btn--outline:hover {
            border-color: #1a9ed4;
            color: #1a9ed4;
        }

        .don-success-icon {
            font-size: 4rem;
            color: #4ac6b9;
            margin-bottom: 16px;
        }
        .don-success-title {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #0d1b3e !important;
            margin: 0 0 10px;
        }
        .don-success-desc {
            font-size: .9rem;
            color: #6b7280;
            max-width: 480px;
            margin: 0 auto 24px;
            line-height: 1.6;
        }
        .don-success-info {
            display: flex;
            flex-direction: column;
            gap: 0;
            max-width: 420px;
            margin: 0 auto;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #eef2f6;
            overflow: hidden;
        }
        .don-success-info__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid #eef2f6;
        }
        .don-success-info__item:last-child {
            border-bottom: none;
        }
        .don-success-info__label {
            font-size: .82rem;
            color: #6b7280;
        }
        .don-success-info__value {
            font-size: .85rem;
            font-weight: 600;
            color: #0d1b3e;
        }
        .don-success-info__value--price {
            color: #db5f5f;
            font-size: 1rem;
        }

        .don-success-payment,
        .don-success-midtrans {
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
            background: #f8fafc;
            border: 1px solid #eef2f6;
            border-radius: 12px;
            padding: 20px;
        }
        .don-success-payment h5,
        .don-success-midtrans h5 {
            font-family: 'Josefin Sans', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: #0d1b3e !important;
            margin: 0 0 12px;
        }
        .don-success-qris {
            display: flex;
            justify-content: center;
            padding: 12px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #eef2f6;
        }
        .don-success-qris img {
            width: 160px;
            height: 160px;
            object-fit: contain;
        }

        .don-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: .72rem;
            font-weight: 700;
        }
        .don-badge--success {
            background: rgba(74,198,185,.15);
            color: #4ac6b9;
        }
        .don-badge--warning {
            background: rgba(255,159,67,.15);
            color: #ff9f43;
        }

        .don-sidebar {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .don-sidebar-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 2px #aaa;
            border-bottom: 3px solid var(--color-primary1);
        }
        .don-sidebar-card__header {
            background: #0d1b3e;
            color: #fff;
            padding: 14px 18px;
            font-weight: 600;
            font-size: .88rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .don-sidebar-card__body {
            padding: 18px;
        }
        .don-sidebar-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .don-sidebar-list li {
            position: relative;
            padding: 6px 0 6px 20px;
            font-size: .84rem;
            color: #6b7280;
            line-height: 1.5;
        }
        .don-sidebar-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 13px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--color-primary1);
        }

        .don-security-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .don-security-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .84rem;
            color: #6b7280;
        }
        .don-security-item i {
            width: 18px;
            color: var(--color-primary1);
            font-size: .9rem;
        }

        .don-payment-methods {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .don-payment-method {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .don-payment-method__icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }
        .don-payment-method__name {
            font-size: .84rem;
            font-weight: 600;
            color: #0d1b3e;
        }
        .don-payment-method__desc {
            font-size: .75rem;
            color: #9ca3af;
        }

        @media (max-width: 992px) {
            .don-wrapper {
                grid-template-columns: 1fr;
            }
            .don-sidebar {
                order: -1;
            }
        }
        @media (max-width: 576px) {
            .don-card {
                padding: 24px 18px;
            }
            .don-actions {
                flex-direction: column;
            }
            .don-actions .don-btn {
                width: 100%;
                justify-content: center;
            }
            .don-amount-presets {
                justify-content: center;
            }
        }
    </style>
</div>
