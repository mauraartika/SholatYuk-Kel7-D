import './bootstrap';
/* ====== DATA SUARA ADZAN ======
       Taruh file audio di: public/audio/adzan/
       Sesuaikan nama file & label sesuai audio yang kamu punya. */
    const ADZAN_SOUNDS = window.SHOLATYUK_CONFIG?.adzanSounds ?? [];

    // ====== UPLOAD AUDIO ADZAN CUSTOM ======

    const namaAudio = document.getElementById('namaAudio');
    const fileAudio = document.getElementById('fileAudio');
    const previewAudio = document.getElementById('previewAudio');
    const addAudio = document.getElementById('addAudio');

    // Menampung audio custom selama halaman terbuka
    const customSounds = [];

    let previewURL = null;

    // Preview audio sebelum ditambahkan
    fileAudio.addEventListener('change', function () {

        const file = this.files[0];

        if (!file) return;

        if (file.type !== 'audio/mpeg' &&
            !file.name.toLowerCase().endsWith('.mp3')) {

            showToast('File harus berformat MP3.', 'error');
            this.value = '';
            previewAudio.style.display = 'none';
            return;
        }

        if (previewURL) {
            URL.revokeObjectURL(previewURL);
        }

        previewURL = URL.createObjectURL(file);

        previewAudio.src = previewURL;
        previewAudio.style.display = 'block';
    });

    // Menambahkan audio ke daftar pilihan
    addAudio.addEventListener('click', function () {

        const name = namaAudio.value.trim();
        const file = fileAudio.files[0];

        if (!name) {
            showToast('Nama adzan harus diisi.', 'error');
            return;
        }

        if (!file) {
            showToast('Silakan pilih file MP3.', 'error');
            return;
        }

        if (customSounds.some(sound =>
            sound.name.toLowerCase() === name.toLowerCase()
        )) {
            showToast('Nama adzan sudah digunakan.', 'error');
            return;
        }

        if (file.type !== 'audio/mpeg' &&
            !file.name.toLowerCase().endsWith('.mp3')) {
            showToast('File harus berformat MP3.', 'error');
            return;
        }

        const sound = {
            id: 'custom-' + Date.now(),
            name: name,
            desc: 'Audio adzan yang ditambahkan sendiri',
            file: previewURL
        };

        customSounds.push(sound);
        ADZAN_SOUNDS.push(sound);

        renderSounds();

        namaAudio.value = '';
        fileAudio.value = '';
        previewAudio.pause();
        previewAudio.removeAttribute('src');
        previewAudio.style.display = 'none';
        previewURL = null;

        showToast('Audio adzan berhasil ditambahkan.');

    });


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

    /* ====== OPEN / CLOSE ====== */
    function openAdzan() {
        selectedSoundId = savedSoundId;
        errorBox.classList.remove('show');
        renderSounds();
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

        // Jika ingin menyimpan ke database, gunakan fetch dengan URL dan token dari SHOLATYUK_CONFIG.
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

    