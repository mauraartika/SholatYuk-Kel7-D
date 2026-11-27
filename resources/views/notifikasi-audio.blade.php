<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SholatYuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <nav class="navbar">
        <a href="{{ url('/') }}" class="brand">Sholat<span>Yuk.</span></a>

        {{-- <div class="nav-links">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/masjid-terdekat') }}">Masjid Terdekat</a>
        <a href="{{ url('/arah-kiblat') }}">Arah Kiblat</a>
        <a href="#" class="active">Profil</a>
    </div> --}}

        <a href="{{ url('/') }}" class="back-link">← Kembali</a>
    </nav>

    <main class="container">

        <section class="heading">
            <div class="eyebrow">Akun & Pengaturan</div>
            <h1>Pengaturan Adzan & Notifikasi.</h1>
            <p class="subtitle">Atur preferensi ibadah dan notifikasi sholat serta dalil.</p>
        </section>

        <!-- FITUR -->
        <section class="menu-card">

            <div class="menu-item" style="cursor:default">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                        <path d="M10.3 21a1.9 1.9 0 0 0 3.4 0" />
                    </svg>
                </span>
                <span class="menu-text">
                    Notifikasi
                    <small>popup & suara adzan saat waktu sholat</small>
                </span>
                <label class="switch">
                    <input type="checkbox" id="notifToggle">
                    <span class="slider"></span>
                </label>
            </div>

            <!-- ADZAN (bisa ditekan) -->
            <button class="menu-item" id="openAdzan" type="button">
                <span class="menu-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 5 6 9H2v6h4l5 4V5z" />
                        <path d="M15.5 8.5a5 5 0 0 1 0 7" />
                        <path d="M19 5a10 10 0 0 1 0 14" />
                    </svg>
                </span>
                <span class="menu-text">Adzan</span>
                <span class="menu-meta" id="currentSoundLabel">Default</span>
                <span class="chevron">›</span>
            </button>

        </section>

    </main>

    <footer class="footer">
        © {{ date('Y') }} SholatYuk — Temani perjalanan ibadahmu.
    </footer>

    <!-- BOTTOM NAV -->
    {{-- <nav class="bottom-nav" aria-label="Navigasi bawah">
    <a href="{{ url('/') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/></svg>
        Beranda
    </a>
    <a href="{{ url('/masjid-terdekat') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 4-6 2v14l6-2 6 2 6-2V4l-6 2z"/><path d="M9 4v14M15 6v14"/></svg>
        Masjid
    </a>
    <a href="#" data-soon="Komunitas">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2 20c0-3.5 3-6 7-6s7 2.5 7 6"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14c2.8 0 5 1.8 5 4.5"/></svg>
        Komunitas
    </a>
    <a href="#" class="active">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3.5"/><path d="M5.5 19c1.5-3 4-4 6.5-4s5 1 6.5 4"/></svg>
        Profil
    </a>
</nav> --}}

    <!-- MODAL PILIHAN ADZAN -->
    <div class="overlay" id="adzanOverlay" aria-hidden="true">
        <div class="sheet" role="dialog" aria-modal="true" aria-labelledby="adzanTitle">

            <div class="sheet-header">
                <div>
                    <h2 id="adzanTitle">Suara Adzan</h2>
                    <p>Tekan ▶ untuk mendengarkan contoh, lalu pilih suara adzan dan tekan Simpan.</p>
                </div>
                <button class="close-btn" id="closeAdzan" type="button" aria-label="Tutup">✕</button>
            </div>

            <!-- FORM TAMBAH AUDIO ADZAN -->
            <div class="upload-audio">
                <h3>+ Tambah Audio Adzan</h3>
                <p>Tambahkan nama dan suara adzan milikmu sendiri.</p>

                <div class="upload-group">
                    <label for="namaAudio">Nama Adzan</label>
                    <input type="text" id="namaAudio" placeholder="Contoh: Adzan Subuh" maxlength="255">
                </div>

                <div class="upload-group">
                    <label for="fileAudio">File Suara Adzan (MP3)</label>
                    <input type="file" id="fileAudio" accept=".mp3,audio/mpeg">
                </div>

                <audio id="previewAudio" class="audio-preview" controls style="display: none;"></audio>

                <button type="button" class="btn-upload" id="addAudio">
                    Tambahkan Audio
                </button>
            </div>

            <div class="sound-list" id="soundList"></div>

            <div class="sheet-footer">
                <div class="form-error" id="adzanError"></div>
                <div class="footer-actions">
                    <button class="btn btn-ghost" id="cancelAdzan" type="button">Batal</button>
                    <button class="btn btn-primary" id="saveAdzan" type="button">Simpan</button>
                </div>
            </div>

        </div>
    </div>

    <div class="toast" id="toast"></div>

    <!-- MODAL KONFIRMASI HAPUS AUDIO -->
    <div class="delete-overlay" id="deleteConfirmOverlay" aria-hidden="true">

        <div class="delete-dialog" role="dialog" aria-modal="true" aria-labelledby="deleteConfirmTitle">

            <h3 id="deleteConfirmTitle">Hapus suara adzan?</h3>

            <p>
                Apakah kamu yakin ingin menghapus suara adzan ini?
                Audio yang sudah dihapus tidak dapat dipulihkan.
            </p>

            <div class="delete-sound-name" id="deleteSoundName">
                Nama suara
            </div>

            <div class="delete-actions">
                <button type="button" class="cancel-delete-btn" id="cancelDeleteSound">
                    Batal
                </button>

                <button type="button" class="confirm-delete-btn" id="confirmDeleteSound">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/notifikasi-audio.js') }}"></script>

</body>

</html>
