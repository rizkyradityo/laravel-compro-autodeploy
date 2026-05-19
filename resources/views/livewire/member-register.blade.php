<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Daftar Member</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">

                    <div class="member-card">
                        <div class="member-card__header">
                            <div class="member-card__icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h3 class="member-card__title">Buat Akun Baru</h3>
                            <p class="member-card__subtitle">Daftar untuk menjadi member PAPRA Indonesia</p>
                        </div>

                        <form wire:submit="register" class="member-form">
                            <div class="member-form__group">
                                <label for="name" class="member-form__label">
                                    <i class="fas fa-user member-form__label-icon"></i>
                                    Nama Lengkap
                                </label>
                                <input wire:model="name" id="name" type="text"
                                    class="member-form__input @error('name') member-form__input--error @enderror"
                                    placeholder="Masukkan nama lengkap"
                                    autocomplete="name">
                                @error('name')
                                    <p class="member-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="member-form__group">
                                <label for="email" class="member-form__label">
                                    <i class="fas fa-envelope member-form__label-icon"></i>
                                    Email
                                </label>
                                <input wire:model="email" id="email" type="email"
                                    class="member-form__input @error('email') member-form__input--error @enderror"
                                    placeholder="Masukkan email"
                                    autocomplete="email">
                                @error('email')
                                    <p class="member-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="member-form__group">
                                <label for="phone" class="member-form__label">
                                    <i class="fas fa-phone member-form__label-icon"></i>
                                    Nomor Telepon
                                </label>
                                <input wire:model="phone" id="phone" type="text"
                                    class="member-form__input @error('phone') member-form__input--error @enderror"
                                    placeholder="Contoh: 08123456789"
                                    autocomplete="tel">
                                @error('phone')
                                    <p class="member-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="member-form__group">
                                <label for="password" class="member-form__label">
                                    <i class="fas fa-lock member-form__label-icon"></i>
                                    Password
                                </label>
                                <input wire:model="password" id="password" type="password"
                                    class="member-form__input @error('password') member-form__input--error @enderror"
                                    placeholder="Minimal 8 karakter"
                                    autocomplete="new-password">
                                @error('password')
                                    <p class="member-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="member-form__group">
                                <label for="password_confirmation" class="member-form__label">
                                    <i class="fas fa-check-circle member-form__label-icon"></i>
                                    Konfirmasi Password
                                </label>
                                <input wire:model="password_confirmation" id="password_confirmation" type="password"
                                    class="member-form__input @error('password_confirmation') member-form__input--error @enderror"
                                    placeholder="Ulangi password"
                                    autocomplete="new-password">
                                @error('password_confirmation')
                                    <p class="member-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="member-form__btn" wire:loading.attr="disabled">
                                <span wire:loading.remove>Daftar</span>
                                <span wire:loading><i class="fas fa-spinner fa-spin"></i> Memproses...</span>
                            </button>
                        </form>

                        <div class="member-divider">
                            <span class="member-divider__text">atau</span>
                        </div>

                        <a href="#" class="member-oauth member-oauth--google" onclick="alert('Google OAuth akan segera tersedia.'); return false;">
                            <i class="fab fa-google"></i>
                            Daftar dengan Google
                        </a>

                        <div class="member-card__footer">
                            Sudah punya akun?
                            <a href="{{ route('member.login') }}" class="member-card__link">Masuk</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .member-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            padding: 40px 32px;
            border-bottom: 3px solid var(--color-primary1);
        }
        .member-card__header {
            text-align: center;
            margin-bottom: 32px;
        }
        .member-card__icon {
            font-size: 3.2rem;
            color: var(--color-primary1);
            margin-bottom: 12px;
        }
        .member-card__title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a2744;
            margin: 0 0 4px;
        }
        .member-card__subtitle {
            font-size: .88rem;
            color: #8895a7;
            margin: 0;
        }
        .member-form__group {
            margin-bottom: 20px;
        }
        .member-form__label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .85rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
        }
        .member-form__label-icon {
            color: var(--color-primary1);
            font-size: .8rem;
            width: 16px;
        }
        .member-form__input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            background: #f8fafc;
        }
        .member-form__input:focus {
            border-color: var(--color-primary1);
            box-shadow: 0 0 0 3px rgba(74,198,185,.15);
            background: #fff;
        }
        .member-form__input--error {
            border-color: #e53e3e;
        }
        .member-form__input--error:focus {
            box-shadow: 0 0 0 3px rgba(229,62,62,.15);
        }
        .member-form__error {
            color: #e53e3e;
            font-size: .8rem;
            margin: 4px 0 0;
        }
        .member-form__btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--color-primary1) 0%, #3ab0a4 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
            margin-top: 8px;
        }
        .member-form__btn:hover {
            opacity: .92;
            transform: translateY(-1px);
        }
        .member-form__btn:disabled {
            opacity: .7;
            cursor: not-allowed;
        }
        .member-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
        }
        .member-divider::before,
        .member-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }
        .member-divider__text {
            font-size: .82rem;
            color: #a0aec0;
            white-space: nowrap;
        }
        .member-oauth {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 600;
            color: #4a5568;
            background: #fff;
            cursor: pointer;
            transition: background .2s, border-color .2s;
            text-decoration: none;
        }
        .member-oauth:hover {
            background: #f7fafc;
            border-color: #cbd5e0;
            color: #2d3748;
        }
        .member-oauth--google i {
            color: #ea4335;
            font-size: 1.1rem;
        }
        .member-card__footer {
            text-align: center;
            margin-top: 24px;
            font-size: .88rem;
            color: #718096;
        }
        .member-card__link {
            color: var(--color-primary1);
            font-weight: 600;
            text-decoration: none;
        }
        .member-card__link:hover {
            color: var(--color-primary2);
        }
    </style>
</div>
