<div>
    <div class="external-div">
        <div class="box-image-page">
            <div class="single-page-img"></div>
        </div>
        <div class="box-text">
            <h2>Edit Profil</h2>
        </div>
    </div>

    <div id="primary" class="content-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">

                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="profile-card">
                        <div class="profile-card__header">
                            <i class="fas fa-user-cog profile-card__header-icon"></i>
                            <h3 class="profile-card__title">Edit Profil</h3>
                            <p class="profile-card__subtitle">Perbarui informasi akun Anda</p>
                        </div>

                        <form wire:submit="save" class="profile-form">

                            <div class="profile-photo">
                                <div class="profile-photo__preview">
                                    @if($photo)
                                        <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="profile-photo__img">
                                    @elseif($existingPhoto)
                                        <img src="{{ Storage::url($existingPhoto) }}" alt="Photo" class="profile-photo__img">
                                    @else
                                        <div class="profile-photo__placeholder">
                                            <i class="fas fa-camera"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="profile-photo__actions">
                                    <label for="photo" class="profile-photo__btn">
                                        <i class="fas fa-upload"></i> Pilih Foto
                                    </label>
                                    <input wire:model="photo" id="photo" type="file" accept="image/*" class="d-none">
                                    <p class="profile-photo__hint">Maksimal 2MB. Format: JPG, PNG</p>
                                </div>
                                @error('photo')
                                    <p class="profile-form__error profile-form__error--center">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="name" class="profile-form__label">
                                            <i class="fas fa-user profile-form__label-icon"></i>
                                            Nama Lengkap
                                        </label>
                                        <input wire:model="name" id="name" type="text"
                                            class="profile-form__input @error('name') profile-form__input--error @enderror"
                                            placeholder="Nama lengkap">
                                        @error('name')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="phone" class="profile-form__label">
                                            <i class="fas fa-phone profile-form__label-icon"></i>
                                            Nomor Telepon
                                        </label>
                                        <input wire:model="phone" id="phone" type="text"
                                            class="profile-form__input @error('phone') profile-form__input--error @enderror"
                                            placeholder="Contoh: 08123456789">
                                        @error('phone')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="birthdate" class="profile-form__label">
                                            <i class="fas fa-calendar profile-form__label-icon"></i>
                                            Tanggal Lahir
                                        </label>
                                        <input wire:model="birthdate" id="birthdate" type="date"
                                            class="profile-form__input @error('birthdate') profile-form__input--error @enderror">
                                        @error('birthdate')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="gender" class="profile-form__label">
                                            <i class="fas fa-venus-mars profile-form__label-icon"></i>
                                            Jenis Kelamin
                                        </label>
                                        <select wire:model="gender" id="gender"
                                            class="profile-form__input @error('gender') profile-form__input--error @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="profile-form__group">
                                <label for="address" class="profile-form__label">
                                    <i class="fas fa-home profile-form__label-icon"></i>
                                    Alamat
                                </label>
                                <textarea wire:model="address" id="address" rows="3"
                                    class="profile-form__input profile-form__textarea @error('address') profile-form__input--error @enderror"
                                    placeholder="Alamat lengkap"></textarea>
                                @error('address')
                                    <p class="profile-form__error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="city" class="profile-form__label">
                                            <i class="fas fa-city profile-form__label-icon"></i>
                                            Kota / Kabupaten
                                        </label>
                                        <input wire:model="city" id="city" type="text"
                                            class="profile-form__input @error('city') profile-form__input--error @enderror"
                                            placeholder="Nama kota">
                                        @error('city')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="profile-form__group">
                                        <label for="province" class="profile-form__label">
                                            <i class="fas fa-map-marker-alt profile-form__label-icon"></i>
                                            Provinsi
                                        </label>
                                        <select wire:model="province" id="province"
                                            class="profile-form__input @error('province') profile-form__input--error @enderror">
                                            <option value="">-- Pilih Provinsi --</option>
                                            @foreach($provinces as $prov)
                                                <option value="{{ $prov }}">{{ $prov }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')
                                            <p class="profile-form__error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="profile-form__actions">
                                <a href="{{ route('member.dashboard') }}" class="profile-form__btn profile-form__btn--secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="profile-form__btn profile-form__btn--primary" wire:loading.attr="disabled">
                                    <span wire:loading.remove><i class="fas fa-save"></i> Simpan</span>
                                    <span wire:loading><i class="fas fa-spinner fa-spin"></i> Menyimpan...</span>
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
            padding: 40px 36px;
            border-bottom: 3px solid var(--color-primary1);
        }
        .profile-card__header {
            text-align: center;
            margin-bottom: 32px;
        }
        .profile-card__header-icon {
            font-size: 2.8rem;
            color: var(--color-primary1);
            margin-bottom: 12px;
        }
        .profile-card__title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a2744;
            margin: 0 0 4px;
        }
        .profile-card__subtitle {
            font-size: .88rem;
            color: #8895a7;
            margin: 0;
        }
        .profile-photo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 32px;
            padding-bottom: 28px;
            border-bottom: 1px solid #f0f2f5;
        }
        .profile-photo__preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 16px;
            border: 4px solid #e2e8f0;
            background: #f7fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-photo__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-photo__placeholder {
            font-size: 2.5rem;
            color: #cbd5e0;
        }
        .profile-photo__actions {
            text-align: center;
        }
        .profile-photo__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: var(--color-primary1);
            color: #fff;
            border-radius: 100px;
            font-size: .88rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s;
            border: none;
        }
        .profile-photo__btn:hover {
            opacity: .9;
            color: #fff;
        }
        .profile-photo__hint {
            font-size: .78rem;
            color: #a0aec0;
            margin: 8px 0 0;
        }
        .profile-form__group {
            margin-bottom: 20px;
        }
        .profile-form__label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: .85rem;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 6px;
        }
        .profile-form__label-icon {
            color: var(--color-primary1);
            font-size: .8rem;
            width: 16px;
        }
        .profile-form__input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: .9rem;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
            background: #f8fafc;
        }
        .profile-form__input:focus {
            border-color: var(--color-primary1);
            box-shadow: 0 0 0 3px rgba(74,198,185,.15);
            background: #fff;
        }
        .profile-form__input--error {
            border-color: #e53e3e;
        }
        .profile-form__input--error:focus {
            box-shadow: 0 0 0 3px rgba(229,62,62,.15);
        }
        .profile-form__textarea {
            resize: vertical;
            min-height: 80px;
        }
        .profile-form__error {
            color: #e53e3e;
            font-size: .8rem;
            margin: 4px 0 0;
        }
        .profile-form__error--center {
            text-align: center;
        }
        .profile-form__actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #f0f2f5;
        }
        .profile-form__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 10px;
            font-size: .9rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity .2s, transform .2s;
            border: none;
            text-decoration: none;
        }
        .profile-form__btn--primary {
            background: linear-gradient(135deg, var(--color-primary1) 0%, #3ab0a4 100%);
            color: #fff;
        }
        .profile-form__btn--primary:hover {
            opacity: .92;
            transform: translateY(-1px);
            color: #fff;
        }
        .profile-form__btn--primary:disabled {
            opacity: .7;
            cursor: not-allowed;
        }
        .profile-form__btn--secondary {
            background: #edf2f7;
            color: #4a5568;
        }
        .profile-form__btn--secondary:hover {
            background: #e2e8f0;
            color: #2d3748;
        }
    </style>
</div>
