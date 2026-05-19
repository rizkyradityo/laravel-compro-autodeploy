<div>
    <div class="page-header">
        <h1>Pengaturan Pembayaran &amp; Umum</h1>
        <p>Konfigurasi Midtrans, Google OAuth, dan informasi situs.</p>
    </div>

    <form wire:submit="save" style="max-width:800px;">
        {{-- Midtrans --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:24px;overflow:hidden;">
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:12px;background:#f8fafc;">
                <div style="width:36px;height:36px;border-radius:8px;background:#eef2ff;display:flex;align-items:center;justify-content:center;color:#6366f1;font-size:1rem;">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">Midtrans Payment Gateway</h3>
                    <p style="font-size:.8rem;color:#64748b;margin:2px 0 0;">Konfigurasi payment gateway Midtrans Snap untuk pembayaran event dan donasi.</p>
                </div>
            </div>

            <div style="padding:24px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                    <div>
                        <label class="form-label">Server Key</label>
                        <input class="form-input" type="password" wire:model="midtrans_server_key" placeholder="SB-Mid-server-xxxxxxxx" />
                        <p style="font-size:.75rem;color:#94a3b8;margin-top:4px;">Midtrans Server Key (sandbox/production)</p>
                    </div>
                    <div>
                        <label class="form-label">Client Key</label>
                        <input class="form-input" type="text" wire:model="midtrans_client_key" placeholder="SB-Mid-client-xxxxxxxx" />
                        <p style="font-size:.75rem;color:#94a3b8;margin-top:4px;">Midtrans Client Key untuk Snap.js</p>
                    </div>
                </div>

                <div>
                    <label class="form-label" style="display:flex;align-items:center;gap:10px;">
                        <input type="checkbox" wire:model="midtrans_enabled" value="1" {{ $midtrans_enabled === '1' ? 'checked' : '' }} style="width:18px;height:18px;" />
                        Aktifkan pembayaran Midtrans
                    </label>
                    <p style="font-size:.75rem;color:#94a3b8;margin:4px 0 0 28px;">Nonaktifkan untuk hanya menggunakan metode QRIS (upload bukti transfer manual)</p>
                </div>
            </div>
        </div>

        {{-- QRIS --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:24px;overflow:hidden;">
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:12px;background:#f8fafc;">
                <div style="width:36px;height:36px;border-radius:8px;background:#f0fdf4;display:flex;align-items:center;justify-content:center;color:#10b981;font-size:1rem;">
                    <i class="fas fa-qrcode"></i>
                </div>
                <div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">QRIS Payment</h3>
                    <p style="font-size:.8rem;color:#64748b;margin:2px 0 0;">Pembayaran via scan QRIS dengan upload bukti transfer manual.</p>
                </div>
            </div>
            <div style="padding:24px;">
                <p style="font-size:.87rem;color:#64748b;">QRIS selalu tersedia sebagai alternatif pembayaran. Upload gambar QRIS di menu <strong>Media</strong> dan gunakan URL-nya di form pendaftaran/donasi jika diperlukan.</p>
            </div>
        </div>

        {{-- Google OAuth --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:24px;overflow:hidden;">
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:12px;background:#f8fafc;">
                <div style="width:36px;height:36px;border-radius:8px;background:#fef2f2;display:flex;align-items:center;justify-content:center;color:#ef4444;font-size:1rem;">
                    <i class="fab fa-google"></i>
                </div>
                <div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">Google OAuth</h3>
                    <p style="font-size:.8rem;color:#64748b;margin:2px 0 0;">Login dengan Google untuk member.</p>
                </div>
            </div>
            <div style="padding:24px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label class="form-label">Client ID</label>
                        <input class="form-input" type="text" wire:model="google_client_id" placeholder="xxxxxxxx.apps.googleusercontent.com" />
                    </div>
                    <div>
                        <label class="form-label">Client Secret</label>
                        <input class="form-input" type="password" wire:model="google_client_secret" placeholder="GOCSPX-xxxxxxxx" />
                    </div>
                </div>
                <p style="font-size:.75rem;color:#94a3b8;margin-top:8px;">
                    Redirect URI: <code style="background:#f1f5f9;padding:2px 6px;border-radius:4px;">{{ url('/api/auth/google/callback') }}</code>
                </p>
            </div>
        </div>

        {{-- Site Info --}}
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:24px;overflow:hidden;">
            <div style="padding:20px 24px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:12px;background:#f8fafc;">
                <div style="width:36px;height:36px;border-radius:8px;background:#faf5ff;display:flex;align-items:center;justify-content:center;color:#a855f7;font-size:1rem;">
                    <i class="fas fa-globe"></i>
                </div>
                <div>
                    <h3 style="font-size:1rem;font-weight:700;color:#0f172a;margin:0;">Informasi Situs</h3>
                    <p style="font-size:.8rem;color:#64748b;margin:2px 0 0;">Nama dan kontak yang tampil di footer.</p>
                </div>
            </div>
            <div style="padding:24px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div>
                        <label class="form-label">Nama Situs</label>
                        <input class="form-input" type="text" wire:model="site_name" placeholder="PAPRA Indonesia" />
                    </div>
                    <div>
                        <label class="form-label">Nomor WhatsApp</label>
                        <input class="form-input" type="text" wire:model="wa_phone" placeholder="6281234567890" />
                        <p style="font-size:.75rem;color:#94a3b8;margin-top:4px;">Format: 628xxx (tanpa +)</p>
                    </div>
                </div>
                <div style="margin-top:16px;">
                    <label class="form-label">Deskripsi Situs</label>
                    <textarea class="form-input" wire:model="site_description" rows="3" placeholder="Deskripsi singkat tentang organisasi..."></textarea>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;padding-bottom:40px;">
            <button type="submit" class="btn btn--primary">
                <i class="fas fa-save"></i> Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
