/* ====== DATA SUARA ADZAN ======*/
let ADZAN_SOUNDS = [];

const DEFAULT_SOUND_ID = 3;
const ENABLED_KEY = 'notification';

const K = {
    sound: 'sholatyuk_adzan',
    enabled: 'sholatyuk_notif_enabled',
    coords: 'sholatyuk_coords',
    times: 'sholatyuk_prayer_times',
    fired: 'sholatyuk_notif_fired'
};

const overlay = document.getElementById('adzanOverlay');
const soundList = document.getElementById('soundList');
const errorBox = document.getElementById('adzanError');
const toastEl = document.getElementById('toast');
const deleteConfirmOverlay = document.getElementById(
    'deleteConfirmOverlay'
);

const deleteSoundName = document.getElementById(
    'deleteSoundName'
);

const cancelDeleteBtn = document.getElementById(
    'cancelDeleteSound'
);

const confirmDeleteBtn = document.getElementById(
    'confirmDeleteSound'
);

let pendingDeleteSound = null;
const labelEl = document.getElementById('currentSoundLabel');

const namaAudioInput = document.getElementById('namaAudio');
const fileAudioInput = document.getElementById('fileAudio');
const previewAudio = document.getElementById('previewAudio');
const addAudioBtn = document.getElementById('addAudio');

let previewAudioURL = null;

let savedSoundId = DEFAULT_SOUND_ID;
let selectedSoundId = DEFAULT_SOUND_ID;
let soundsLoaded = false;
let audio = null;
let playingId = null;
let toastTimer = null;

/* ====== TOAST ====== */
function showToast(text, type = 'success') {
    toastEl.className = 'toast ' + type;
    toastEl.textContent = text;
    requestAnimationFrame(() => toastEl.classList.add('show'));
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2800);
}

/* ====== LOAD SUARA DARI DATABASE ====== */
async function loadSounds() {
    try {
        const response = await fetch('/api/suara-adzan', {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json'
            },
            cache: 'no-store'
        });

        if (!response.ok) {
            throw new Error(
                'Gagal mengambil daftar suara. HTTP ' + response.status
            );
        }

        const data = await response.json();

        ADZAN_SOUNDS = data.map(sound => ({
            id: Number(sound.id),
            name: sound.nama_suara,
            desc: sound.is_custom ?
                'Suara custom milikmu' : 'Suara bawaan aplikasi',
            file: sound.file_audio,
            isCustom: sound.is_custom,
            isSelected: sound.is_selected
        }));

        const selectedSound = ADZAN_SOUNDS.find(
            sound => sound.isSelected
        );

        savedSoundId = selectedSound ?
            selectedSound.id :
            DEFAULT_SOUND_ID;

        selectedSoundId = savedSoundId;
        soundsLoaded = true;

        updateLabel();

        console.log('Daftar suara berhasil dimuat:', ADZAN_SOUNDS);

        return true;

    } catch (error) {
        console.error('Gagal memuat suara adzan:', error);
        showToast('Gagal memuat daftar suara adzan.', 'error');

        return false;
    }
}

/* ====== AUDIO PREVIEW ====== */
function stopAudio() {
    if (audio) {
        audio.pause();
        audio.currentTime = 0;
        audio = null;
    }

    playingId = null;

    document.querySelectorAll('.play-btn').forEach(button => {
        button.classList.remove('playing');
        button.textContent = '▶';
    });
}

function togglePlay(sound, button) {
    const soundId = Number(sound.id);

    // Klik tombol yang sama saat sedang diputar = stop
    if (playingId === soundId) {
        stopAudio();
        return;
    }

    stopAudio();

    audio = new Audio(sound.file);
    playingId = soundId;

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

        row.className = 'sound-option' +
            (Number(sound.id) === Number(selectedSoundId) ? ' selected' : '');

        row.dataset.id = sound.id;

        const play = document.createElement('button');
        play.type = 'button';
        play.className = 'play-btn';
        play.textContent = '▶';
        play.setAttribute('aria-label', 'Putar contoh ' + sound.name);

        play.addEventListener('click', e => {
            e.stopPropagation();
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

        // Tombol hapus hanya untuk audio buatan pengguna
        if (sound.isCustom) {
            const deleteBtn = document.createElement('button');
            deleteBtn.type = 'button';
            deleteBtn.className = 'delete-sound-btn';
            deleteBtn.textContent = '🗑';
            deleteBtn.setAttribute('aria-label', 'Hapus ' + sound.name);
            deleteBtn.title = 'Hapus suara ini';

            deleteBtn.addEventListener('click', async e => {
                e.stopPropagation();
                await deleteSound(sound);
            });

            row.appendChild(deleteBtn);
        }

        row.addEventListener('click', () => {
            selectSound(Number(sound.id));
        });

        soundList.appendChild(row);
    });
}

// Membuka modal konfirmasi
function deleteSound(sound) {
    pendingDeleteSound = sound;

    deleteSoundName.textContent = sound.name;

    deleteConfirmOverlay.classList.add('show');
    deleteConfirmOverlay.setAttribute('aria-hidden', 'false');
}

// Menutup modal konfirmasi
function closeDeleteModal() {
    deleteConfirmOverlay.classList.remove('show');
    deleteConfirmOverlay.setAttribute('aria-hidden', 'true');

    pendingDeleteSound = null;
    confirmDeleteBtn.disabled = false;
    confirmDeleteBtn.textContent = 'Hapus';
}

// Menjalankan penghapusan setelah dikonfirmasi
async function confirmDelete() {
    if (!pendingDeleteSound) return;

    const sound = pendingDeleteSound;

    try {
        confirmDeleteBtn.disabled = true;
        confirmDeleteBtn.textContent = 'Menghapus...';

        if (Number(playingId) === Number(sound.id)) {
            stopAudio();
        }

        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        )?.getAttribute('content');

        if (!csrfToken) {
            throw new Error('Token keamanan tidak ditemukan.');
        }

        const response = await fetch(
            `/api/suara-adzan/${sound.id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            }
        );

        const result = await response.json();

        if (!response.ok) {
            throw new Error(
                result.message || 'Gagal menghapus suara adzan.'
            );
        }

        closeDeleteModal();

        const success = await loadSounds();

        if (!success) {
            showToast(
                'Audio terhapus, tetapi daftar gagal dimuat ulang.',
                'error'
            );
            return;
        }

        renderSounds();

        showToast(
            'Suara "' + sound.name + '" berhasil dihapus.',
            'success'
        );

    } catch (error) {
        console.error('Gagal menghapus suara:', error);

        showToast(
            error.message || 'Terjadi kesalahan saat menghapus suara.',
            'error'
        );

        confirmDeleteBtn.disabled = false;
        confirmDeleteBtn.textContent = 'Hapus';
    }
}

function selectSound(id) {
    selectedSoundId = Number(id);

    errorBox.classList.remove('show');

    document.querySelectorAll('.sound-option').forEach(el => {
        el.classList.toggle(
            'selected',
            Number(el.dataset.id) === selectedSoundId
        );
    });
}

/* ====== OPEN / CLOSE ====== */
async function openAdzan() {
    selectedSoundId = savedSoundId;

    errorBox.classList.remove('show');

    overlay.classList.add('show');
    overlay.setAttribute('aria-hidden', 'false');

    if (!soundsLoaded) {
        soundList.textContent = 'Memuat daftar suara...';

        const success = await loadSounds();

        if (!success) {
            soundList.textContent =
                'Gagal memuat suara adzan. Silakan coba kembali.';
            return;
        }
    }

    selectedSoundId = savedSoundId;
    renderSounds();
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
    if (!ADZAN_SOUNDS.some(s => s.id === Number(id))) {
        return 'Suara adzan yang dipilih tidak valid.';
    }
    return null;
}

async function saveAdzan() {
    const error = validateSound(selectedSoundId);

    if (error) {
        errorBox.textContent = error;
        errorBox.classList.add('show');
        return;
    }

    try {
        const response = await fetch('/api/suara-adzan/select', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector(
                    'meta[name="csrf-token"]'
                ).content
            },
            body: JSON.stringify({
                suara_adzan_id: selectedSoundId
            })
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(
                result.message || 'Gagal menyimpan pilihan suara adzan.'
            );
        }

        savedSoundId = Number(result.suara_adzan_id);

        updateLabel();
        closeAdzan();

        const selectedSound = ADZAN_SOUNDS.find(
            sound => Number(sound.id) === savedSoundId
        );

        const name = selectedSound ?
            selectedSound.name :
            'Suara adzan';

        showToast('Suara adzan "' + name + '" berhasil disimpan.');

    } catch (error) {
        console.error('Gagal menyimpan pilihan suara:', error);

        errorBox.textContent = error.message ||
            'Gagal menyimpan preferensi. Coba lagi.';

        errorBox.classList.add('show');
    }
}

function updateLabel() {
    const found = ADZAN_SOUNDS.find(
        sound => sound.id === Number(savedSoundId)
    );

    labelEl.textContent = found ? found.name : 'Adzan Default';
}


/* ====== UPLOAD AUDIO ADZAN ====== */

// Preview audio ketika file dipilih
fileAudioInput.addEventListener('change', () => {
    const file = fileAudioInput.files[0];

    // Bersihkan preview sebelumnya
    if (previewAudioURL) {
        URL.revokeObjectURL(previewAudioURL);
        previewAudioURL = null;
    }

    previewAudio.pause();
    previewAudio.removeAttribute('src');
    previewAudio.style.display = 'none';

    if (!file) return;

    const isMp3 = file.name.toLowerCase().endsWith('.mp3');

    if (!isMp3) {
        showToast('File harus berformat MP3.', 'error');
        fileAudioInput.value = '';
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showToast('Ukuran file maksimal 5 MB.', 'error');
        fileAudioInput.value = '';
        return;
    }

    previewAudioURL = URL.createObjectURL(file);
    previewAudio.src = previewAudioURL;
    previewAudio.style.display = 'block';
});

// Upload audio ke Laravel
addAudioBtn.addEventListener('click', async () => {
    const nama = namaAudioInput.value.trim();
    const file = fileAudioInput.files[0];

    if (!nama) {
        showToast('Nama adzan harus diisi.', 'error');
        namaAudioInput.focus();
        return;
    }

    if (!file) {
        showToast('Pilih file MP3 terlebih dahulu.', 'error');
        fileAudioInput.focus();
        return;
    }

    if (!file.name.toLowerCase().endsWith('.mp3')) {
        showToast('File harus berformat MP3.', 'error');
        return;
    }

    if (file.size > 5 * 1024 * 1024) {
        showToast('Ukuran file maksimal 5 MB.', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('nama_suara', nama);
    formData.append('file_audio', file);

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    )?.content;

    if (!csrfToken) {
        showToast('Token keamanan tidak ditemukan. Muat ulang halaman.', 'error');
        return;
    }

    addAudioBtn.disabled = true;
    addAudioBtn.textContent = 'Mengunggah...';

    try {
        const response = await fetch('/api/suara-adzan', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });

        const result = await response.json();

        if (!response.ok) {
            const validationMessage = result.errors ?
                Object.values(result.errors).flat().join(' ') :
                result.message;

            throw new Error(
                validationMessage || 'Gagal mengunggah audio adzan.'
            );
        }

        // Bersihkan form setelah berhasil
        namaAudioInput.value = '';
        fileAudioInput.value = '';

        previewAudio.pause();
        previewAudio.removeAttribute('src');
        previewAudio.style.display = 'none';

        if (previewAudioURL) {
            URL.revokeObjectURL(previewAudioURL);
            previewAudioURL = null;
        }

        // Ambil ulang daftar audio dari database
        const success = await loadSounds();

        if (!success) {
            showToast('Audio tersimpan, tetapi daftar gagal dimuat ulang.', 'error');
            return;
        }

        renderSounds();

        showToast(
            'Audio "' + result.data.nama_suara + '" berhasil ditambahkan.'
        );

    } catch (error) {
        console.error('Upload audio gagal:', error);
        showToast(error.message || 'Terjadi kesalahan saat upload.', 'error');

    } finally {
        addAudioBtn.disabled = false;
        addAudioBtn.textContent = 'Tambahkan Audio';
    }
});

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
const NOTIF_KEY = 'sholatyuk_notif_enabled';
const notifToggle = document.getElementById('notifToggle');

notifToggle.checked = localStorage.getItem(NOTIF_KEY) === '1';

notifToggle.addEventListener('change', async () => {
    if (notifToggle.checked) {
        // minta izin notifikasi perangkat (popup di dalam aplikasi tetap jalan walau ditolak)
        let result = 'unsupported';
        if (window.PrayerNotif) result = await PrayerNotif.enableSystem();

        localStorage.setItem(NOTIF_KEY, '1');

        if (result === 'denied') {
            showToast('Notifikasi aktif. Izin perangkat diblokir, popup tetap muncul di halaman.',
                'error');
        } else {
            showToast('Notifikasi diaktifkan.');
        }
    } else {
        localStorage.setItem(NOTIF_KEY, '0');
        if (window.PrayerNotif) PrayerNotif.close(); // hentikan popup/adzan yang sedang tampil
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

// Inisialisasi preferensi suara adzan dari database
async function initializeAdzan() {
    const success = await loadSounds();

    if (!success) return;

    /* Buka modal otomatis jika datang dari home (?adzan=1) */
    if (new URLSearchParams(location.search).get('adzan') === '1') {
        await openAdzan();
        history.replaceState(null, '', location.pathname);
    }
}

// Event modal konfirmasi hapus
cancelDeleteBtn.addEventListener('click', closeDeleteModal);

confirmDeleteBtn.addEventListener('click', confirmDelete);

deleteConfirmOverlay.addEventListener('click', e => {
    if (e.target === deleteConfirmOverlay) {
        closeDeleteModal();
    }
});

// Tutup modal dengan tombol Escape
document.addEventListener('keydown', e => {
    if (
        e.key === 'Escape' &&
        deleteConfirmOverlay.classList.contains('show')
    ) {
        closeDeleteModal();
    }
});

initializeAdzan();
