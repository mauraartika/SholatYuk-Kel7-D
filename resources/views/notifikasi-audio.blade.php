<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SholatYuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #315c46;
            --dark: #1d3026;
            --cream: #f7f7f2;
            --muted: #78847c;
            --line: #e8ebe5;
            --gold: #b18a54;
            --mint: #edf3ed;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; }

        /* NAVBAR */
        .navbar {
            height: 76px;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-bottom: 1px solid var(--line);
        }
        .brand { font-size: 23px; font-weight: 800; color: var(--green); }
        .brand span { color: var(--gold); }
        .nav-links { display: flex; gap: 30px; font-size: 14px; font-weight: 600; color: #66736a; }
        .nav-links a:hover, .nav-links .active { color: var(--green); }
        .back-link {
            padding: 10px 17px; border: 1px solid var(--line);
            border-radius: 30px; font-size: 13px; font-weight: 700;
        }

        /* LAYOUT */
        .container {
            max-width: 620px;
            margin: auto;
            padding: 45px 20px 130px;
        }

        .heading { text-align: center; margin-bottom: 28px; }
        .eyebrow {
            color: var(--gold); font-size: 12px; font-weight: 800;
            letter-spacing: 2px; text-transform: uppercase; margin-bottom: 12px;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 44px);
            margin-bottom: 10px;
        }
        .subtitle { color: var(--muted); font-size: 14px; line-height: 1.7; }

        /* MENU */
        .menu-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 15px 45px rgba(30, 50, 38, .04);
            margin-bottom: 18px;
        }

        .section-label {
            padding: 18px 22px 6px;
            font-size: 11px; font-weight: 800;
            letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--muted);
        }

        .menu-item {
            width: 100%;
            display: flex; align-items: center; gap: 14px;
            padding: 15px 22px;
            background: white; border: none;
            border-bottom: 1px solid #f0f1ed;
            cursor: pointer; text-align: left;
            font-size: 14px; font-weight: 700; color: var(--dark);
            transition: .2s;
        }
        .menu-item:last-child { border-bottom: none; }
        .menu-item:hover { background: #f8faf7; }

        .menu-icon {
            width: 38px; height: 38px; flex-shrink: 0;
            display: grid; place-items: center;
            background: var(--mint); color: var(--green);
            border-radius: 12px;
        }
        .menu-icon svg { width: 19px; height: 19px; }

        .menu-text { flex: 1; }
        .menu-text small {
            display: block; margin-top: 2px;
            font-size: 11px; font-weight: 500; color: var(--muted);
        }

        .menu-meta { font-size: 12px; font-weight: 700; color: var(--gold); }
        .chevron { color: #aab4ac; font-size: 18px; }

        /* TOGGLE */
        .switch { position: relative; width: 46px; height: 26px; flex-shrink: 0; }
        .switch input { display: none; }
        .slider {
            position: absolute; inset: 0;
            background: #d5dcd5; border-radius: 30px;
            cursor: pointer; transition: .25s;
        }
        .slider::before {
            content: ''; position: absolute;
            width: 20px; height: 20px; left: 3px; top: 3px;
            background: white; border-radius: 50%;
            box-shadow: 0 1px 4px #0003; transition: .25s;
        }
        .switch input:checked + .slider { background: var(--green); }
        .switch input:checked + .slider::before { transform: translateX(20px); }

        /* BOTTOM NAV */
        .bottom-nav {
            position: fixed; bottom: 18px; left: 50%;
            transform: translateX(-50%);
            width: min(380px, calc(100% - 32px));
            display: flex; justify-content: space-around; align-items: center;
            padding: 12px 14px;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(8px);
            border: 1.5px solid #cfdccf;
            border-radius: 40px;
            box-shadow: 0 12px 35px rgba(30,50,38,.12);
            z-index: 50;
        }
        .bottom-nav a {
            display: flex; flex-direction: column; align-items: center; gap: 3px;
            color: #8fa596; font-size: 10px; font-weight: 700;
            padding: 6px 14px; border-radius: 20px; transition: .2s;
        }
        .bottom-nav a svg { width: 24px; height: 24px; }
        .bottom-nav a:hover { color: var(--green); }
        .bottom-nav a.active { color: var(--green); background: var(--mint); }

        /* ADZAN MODAL */
        .overlay {
            position: fixed; inset: 0;
            background: rgba(29, 48, 38, .45);
            display: none; align-items: center; justify-content: center;
            padding: 16px; z-index: 100;
        }
        .overlay.show { display: flex; }

        .sheet {
            width: min(480px, 100%);
            max-height: 88vh;
            display: flex; flex-direction: column;
            background: white; border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0,0,0,.25);
            animation: pop .25s ease;
        }
        @keyframes pop {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: none; opacity: 1; }
        }

        .sheet-header {
            padding: 22px 24px 16px;
            border-bottom: 1px solid var(--line);
            display: flex; justify-content: space-between; align-items: flex-start; gap: 12px;
        }
        .sheet-header h2 { font-family: 'Playfair Display', serif; font-size: 22px; margin-bottom: 5px; }
        .sheet-header p { font-size: 12px; color: var(--muted); line-height: 1.6; }
        .close-btn {
            width: 34px; height: 34px; flex-shrink: 0;
            border: 1px solid var(--line); background: white;
            border-radius: 50%; cursor: pointer; font-size: 15px; color: var(--muted);
        }
        .close-btn:hover { background: var(--mint); }

        /* BOX NOTIFIKASI POPUP */
        .notif-box {
            display: flex; align-items: center; justify-content: space-between; gap: 12px;
            margin: 12px 12px 0; padding: 14px 16px;
            background: var(--mint); border-radius: 16px;
        }
        .notif-text strong { display: block; font-size: 13px; margin-bottom: 3px; }
        .notif-text small { font-size: 11px; color: var(--muted); line-height: 1.5; display: block; }
        .notif-btn {
            flex-shrink: 0; padding: 9px 16px; border-radius: 30px;
            border: none; background: var(--green); color: white;
            font-size: 12px; font-weight: 700; cursor: pointer; transition: .2s;
        }
        .notif-btn:hover { background: var(--dark); }
        .notif-btn:disabled { background: #b9c7bc; cursor: default; transform: none; }

        .sound-list { padding: 12px; overflow-y: auto; }

        .sound-option {
            display: flex; align-items: center; gap: 12px;
            padding: 13px 14px; margin-bottom: 8px;
            border: 1.5px solid var(--line);
            border-radius: 16px; cursor: pointer; transition: .2s;
        }
        .sound-option:hover { background: #f8faf7; }
        .sound-option.selected { border-color: var(--green); background: var(--mint); }

        .play-btn {
            width: 40px; height: 40px; flex-shrink: 0;
            border: none; border-radius: 50%;
            background: var(--green); color: white;
            cursor: pointer; font-size: 13px;
            display: grid; place-items: center; transition: .2s;
        }
        .play-btn:hover { background: var(--dark); transform: scale(1.06); }
        .play-btn.playing { background: var(--gold); }

        .sound-info { flex: 1; min-width: 0; }
        .sound-info strong { display: block; font-size: 14px; margin-bottom: 3px; }
        .sound-info small { font-size: 11px; color: var(--muted); }

        .radio {
            width: 22px; height: 22px; flex-shrink: 0;
            border: 2px solid #c8d2c9; border-radius: 50%;
            display: grid; place-items: center; transition: .2s;
        }
        .sound-option.selected .radio { border-color: var(--green); }
        .sound-option.selected .radio::after {
            content: ''; width: 10px; height: 10px;
            background: var(--green); border-radius: 50%;
        }

        .sheet-footer { padding: 16px 24px 22px; border-top: 1px solid var(--line); }
        .form-error {
            display: none; margin-bottom: 12px;
            padding: 10px 14px; border-radius: 12px;
            background: #fdf0ec; color: #b2553c;
            font-size: 12px; font-weight: 700;
        }
        .form-error.show { display: block; }

        .footer-actions { display: flex; gap: 10px; }
        .btn {
            flex: 1; padding: 14px; border-radius: 30px;
            font-size: 13px; font-weight: 700; cursor: pointer; transition: .2s;
        }
        .btn-primary { background: var(--green); color: white; border: none; }
        .btn-primary:hover { background: var(--dark); transform: translateY(-1px); }
        .btn-ghost { background: white; color: var(--green); border: 1px solid var(--line); }
        .btn-ghost:hover { background: var(--mint); }

        /* TOAST */
        .toast {
            position: fixed; top: 90px; left: 50%;
            transform: translate(-50%, -20px);
            background: var(--dark); color: white;
            padding: 13px 20px; border-radius: 30px;
            font-size: 13px; font-weight: 700;
            box-shadow: 0 10px 30px rgba(0,0,0,.2);
            opacity: 0; pointer-events: none;
            transition: .3s; z-index: 200;
            max-width: calc(100% - 32px); text-align: center;
        }
        .toast.show { opacity: 1; transform: translate(-50%, 0); }
        .toast.success::before { content: '✓ '; color: #8fd4a4; }
        .toast.error::before { content: '⚠ '; }

        .footer { text-align: center; padding: 0 25px 25px; color: var(--muted); font-size: 12px; }

        @media (max-width: 650px) {
            .navbar { padding: 0 20px; }
            .nav-links { display: none; }
            .container { padding: 35px 15px 130px; }
        }
    </style>
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.9 1.9 0 0 0 3.4 0"/></svg>
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5 6 9H2v6h4l5 4V5z"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M19 5a10 10 0 0 1 0 14"/></svg>
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

        <!-- NOTIFIKASI POPUP -->
        <div class="notif-box">
            <div class="notif-text">
                <strong>Notifikasi popup</strong>
                <small id="notifStatusText">Belum aktif</small>
            </div>
            <button class="notif-btn" id="enableNotif" type="button">Aktifkan</button>
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

<script>
    /* ====== DATA SUARA ADZAN ======
       Taruh file audio di: public/audio/adzan/
       Sesuaikan nama file & label sesuai audio yang kamu punya. */
    const ADZAN_SOUNDS = [
        { id: 'default',  name: 'Default',        desc: 'Suara bawaan aplikasi',  file: "{{ asset('audio/adzan/default.mp3') }}" },
        { id: 'makkah',   name: 'Adzan Makkah',   desc: 'Gaya Masjidil Haram',    file: "{{ asset('audio/adzan/makkah.mp3') }}" },
        { id: 'madinah',  name: 'Adzan Madinah',  desc: 'Gaya Masjid Nabawi',     file: "{{ asset('audio/adzan/madinah.mp3') }}" },
        { id: 'alaqsa',   name: 'Adzan Al-Aqsa',  desc: 'Gaya Masjid Al-Aqsa',    file: "{{ asset('audio/adzan/alaqsa.mp3') }}" },
        { id: 'subuh',    name: 'Adzan Subuh',    desc: 'Dengan tambahan Ash-sholatu khairum minan-naum', file: "{{ asset('audio/adzan/subuh.mp3') }}" }
    ];

    const STORAGE_KEY = 'sholatyuk_adzan';
    const ENABLED_KEY = 'notification';
     const K = {
        sound:   'sholatyuk_adzan',
        enabled: 'sholatyuk_notif_enabled',
        coords:  'sholatyuk_coords',
        times:   'sholatyuk_prayer_times',
        fired:   'sholatyuk_notif_fired'
    };

    const overlay    = document.getElementById('adzanOverlay');
    const soundList  = document.getElementById('soundList');
    const errorBox   = document.getElementById('adzanError');
    const toastEl    = document.getElementById('toast');
    const labelEl    = document.getElementById('currentSoundLabel');

    let savedSoundId    = localStorage.getItem(STORAGE_KEY) || 'default';
    let selectedSoundId = savedSoundId;
    let audio           = null;
    let playingId       = null;
    let toastTimer      = null;

    /* ====== TOAST ====== */
    function showToast(text, type = 'success') {
        toastEl.className = 'toast ' + type;
        toastEl.textContent = text;
        requestAnimationFrame(() => toastEl.classList.add('show'));
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2800);
    }

    /* ====== AUDIO PREVIEW ====== */
    function stopAudio() {
        if (audio) {
            audio.pause();
            audio.currentTime = 0;
            audio = null;
        }
        playingId = null;
        document.querySelectorAll('.play-btn').forEach(b => {
            b.classList.remove('playing');
            b.textContent = '▶';
        });
    }

    function togglePlay(sound, button) {
        // klik tombol yang sama saat sedang diputar = stop
        if (playingId === sound.id) {
            stopAudio();
            return;
        }

        stopAudio();

        audio = new Audio(sound.file);
        playingId = sound.id;
        button.classList.add('playing');
        button.textContent = '❚❚';

        audio.addEventListener('ended', stopAudio);
        audio.addEventListener('error', () => {
            stopAudio();
            showToast('File audio "' + sound.name + '" tidak ditemukan.', 'error');
        });

        audio.play().catch(() => {
            stopAudio();
            showToast('Audio tidak bisa diputar di perangkat ini.', 'error');
        });
    }

    /* ====== RENDER LIST ====== */
    function renderSounds() {
        soundList.innerHTML = '';

        ADZAN_SOUNDS.forEach(sound => {
            const row = document.createElement('div');
            row.className = 'sound-option' + (sound.id === selectedSoundId ? ' selected' : '');
            row.dataset.id = sound.id;

            const play = document.createElement('button');
            play.type = 'button';
            play.className = 'play-btn';
            play.textContent = '▶';
            play.setAttribute('aria-label', 'Putar contoh ' + sound.name);
            play.addEventListener('click', e => {
                e.stopPropagation();          // jangan ikut memilih saat cuma preview
                togglePlay(sound, play);
            });

            const info = document.createElement('div');
            info.className = 'sound-info';
            const title = document.createElement('strong');
            title.textContent = sound.name;
            const desc = document.createElement('small');
            desc.textContent = sound.desc;
            info.append(title, desc);

            const radio = document.createElement('span');
            radio.className = 'radio';

            row.append(play, info, radio);
            row.addEventListener('click', () => selectSound(sound.id));
            soundList.appendChild(row);
        });
    }

    function selectSound(id) {
        selectedSoundId = id;
        errorBox.classList.remove('show');
        document.querySelectorAll('.sound-option').forEach(el => {
            el.classList.toggle('selected', el.dataset.id === id);
        });
    }

    /* ====== NOTIFIKASI POPUP ====== */
    const notifBtn    = document.getElementById('enableNotif');
    const notifStatus = document.getElementById('notifStatusText');

    function refreshNotif() {
        if (!('Notification' in window)) {
            notifStatus.textContent = 'Browser ini belum mendukung notifikasi.';
            notifBtn.disabled = true;
            return;
        }

        const perm = Notification.permission;

        if (perm === 'granted') {
            notifStatus.textContent = 'Aktif. Popup dan suara adzan muncul saat waktu sholat tiba.';
            notifBtn.textContent = 'Aktif ✓';
            notifBtn.disabled = true;
        } else if (perm === 'denied') {
            notifStatus.textContent = 'Diblokir. Izinkan lewat pengaturan situs di browser.';
            notifBtn.disabled = true;
        } else {
            notifStatus.textContent = 'Belum aktif. Izinkan agar notifikasi muncul di perangkat.';
            notifBtn.textContent = 'Aktifkan';
            notifBtn.disabled = false;
        }
    }

    notifBtn.addEventListener('click', async () => {
        if (!window.PrayerNotif) return;
        const result = await PrayerNotif.enableSystem();
        refreshNotif();
        showToast(
            result === 'granted' ? 'Notifikasi berhasil diaktifkan.' : 'Izin notifikasi belum diberikan.',
            result === 'granted' ? 'success' : 'error'
        );
    });

    /* ====== OPEN / CLOSE ====== */
    function openAdzan() {
        selectedSoundId = savedSoundId;
        errorBox.classList.remove('show');
        renderSounds();
        refreshNotif();
        overlay.classList.add('show');
        overlay.setAttribute('aria-hidden', 'false');
    }

    function closeAdzan() {
        stopAudio();
        overlay.classList.remove('show');
        overlay.setAttribute('aria-hidden', 'true');
    }

    /* ====== VALIDASI + SIMPAN ====== */
    function validateSound(id) {
        if (!id) {
            return 'Pilih salah satu suara adzan terlebih dahulu.';
        }
        if (!ADZAN_SOUNDS.some(s => s.id === id)) {
            return 'Suara adzan yang dipilih tidak valid.';
        }
        return null;
    }

    function saveAdzan() {
        const error = validateSound(selectedSoundId);

        if (error) {
            errorBox.textContent = error;
            errorBox.classList.add('show');
            return;
        }

        try {
            localStorage.setItem(STORAGE_KEY, selectedSoundId);
        } catch (e) {
            errorBox.textContent = 'Gagal menyimpan preferensi. Coba lagi.';
            errorBox.classList.add('show');
            return;
        }

        /* Opsional: simpan ke database lewat Laravel
        fetch("{{ url('/profile/adzan') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ sound: selectedSoundId })
        });
        */

        savedSoundId = selectedSoundId;
        updateLabel();
        closeAdzan();

        const name = ADZAN_SOUNDS.find(s => s.id === savedSoundId).name;
        showToast('Suara adzan "' + name + '" berhasil disimpan.');
    }

    function updateLabel() {
        const found = ADZAN_SOUNDS.find(s => s.id === savedSoundId);
        labelEl.textContent = found ? found.name : 'Default';
    }

    /* ====== EVENTS ====== */
    document.getElementById('openAdzan').addEventListener('click', openAdzan);
    document.getElementById('closeAdzan').addEventListener('click', closeAdzan);
    document.getElementById('cancelAdzan').addEventListener('click', closeAdzan);
    document.getElementById('saveAdzan').addEventListener('click', saveAdzan);

    overlay.addEventListener('click', e => {
        if (e.target === overlay) closeAdzan();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && overlay.classList.contains('show')) closeAdzan();
    });

    /* ====== TOGGLE NOTIFIKASI ====== */
    const NOTIF_KEY   = 'sholatyuk_notif_enabled';
    const notifToggle = document.getElementById('notifToggle');

    notifToggle.checked = localStorage.getItem(NOTIF_KEY) === '1';

    notifToggle.addEventListener('change', async () => {
        if (notifToggle.checked) {
            // minta izin notifikasi perangkat (popup di dalam aplikasi tetap jalan walau ditolak)
            let result = 'unsupported';
            if (window.PrayerNotif) result = await PrayerNotif.enableSystem();

            localStorage.setItem(NOTIF_KEY, '1');

            if (result === 'denied') {
                showToast('Notifikasi aktif. Izin perangkat diblokir, popup tetap muncul di halaman.', 'error');
            } else {
                showToast('Notifikasi diaktifkan.');
            }
        } else {
            localStorage.setItem(NOTIF_KEY, '0');
            if (window.PrayerNotif) PrayerNotif.close();   // hentikan popup/adzan yang sedang tampil
            showToast('Notifikasi dimatikan.');
        }
    });

    /* Menu yang belum dibuat halamannya */
    document.querySelectorAll('[data-soon]').forEach(el => {
        el.addEventListener('click', e => {
            e.preventDefault();
            showToast('Fitur ' + el.dataset.soon + ' segera hadir.', 'error');
        });
    });

    updateLabel();

    /* Buka modal adzan otomatis kalau datang dari home (?adzan=1) */
    if (new URLSearchParams(location.search).get('adzan') === '1') {
        openAdzan();
        history.replaceState(null, '', location.pathname);
    }
</script>

</body>
</html>
