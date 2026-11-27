(function () {
    const ENABLED_KEY = 'sholatyuk_notif_enabled';
    const TIMES_KEY = 'sholatyuk_prayer_times';
    const FIRED_KEY = 'sholatyuk_notif_fired';

    let timer = null;

    // Membuat tampilan popup
    function createPopup() {
        if (document.getElementById('prayerPopup')) return;

        const style = document.createElement('style');
        style.textContent = `
            #prayerPopup {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: rgba(0,0,0,.45);
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            #prayerPopup.show {
                display: flex;
            }

            .prayer-popup-card {
                background: #fff;
                width: 100%;
                max-width: 360px;
                padding: 30px 24px;
                border-radius: 20px;
                text-align: center;
                color: #18251e;
                font-family: Arial, sans-serif;
                box-shadow: 0 10px 40px rgba(0,0,0,.15);
            }

            .prayer-popup-icon {
                font-size: 38px;
                margin-bottom: 12px;
            }

            .prayer-popup-card h2 {
                margin: 0 0 10px;
                color: #315c46;
            }

            .prayer-popup-card p {
                color: #68736b;
                font-size: 14px;
                line-height: 1.6;
            }

            #closePrayerPopup {
                background: #315c46;
                color: white;
                border: none;
                border-radius: 30px;
                padding: 12px 28px;
                margin-top: 12px;
                cursor: pointer;
            }
        `;

        document.head.appendChild(style);

        const popup = document.createElement('div');
        popup.id = 'prayerPopup';

        popup.innerHTML = `
            <div class="prayer-popup-card">
                <div class="prayer-popup-icon">☾</div>
                <h2 id="popupPrayerName">Waktu Sholat</h2>
                <p>Waktu sholat telah tiba. Mari tunaikan ibadah sholat.</p>
                <button id="closePrayerPopup">Tutup</button>
            </div>
        `;

        document.body.appendChild(popup);

        document.getElementById('closePrayerPopup')
            .addEventListener('click', function () {
                popup.classList.remove('show');
            });
    }

    // Menampilkan popup
    function showPopup(prayerName) {
        createPopup();

        document.getElementById('popupPrayerName').textContent =
            'Waktu ' + prayerName;

        document.getElementById('prayerPopup').classList.add('show');
    }

    // Memeriksa waktu sholat
    function checkPrayerTime() {
        if (localStorage.getItem(ENABLED_KEY) !== '1') return;

        const savedTimes = localStorage.getItem(TIMES_KEY);
        if (!savedTimes) return;

        const schedule = JSON.parse(savedTimes);

        const now = new Date();
        const currentTime = now.toTimeString().slice(0, 5);
        const today = now.toLocaleDateString('en-CA');

        const prayers = {
            Fajr: 'Subuh',
            Dhuhr: 'Dzuhur',
            Asr: 'Ashar',
            Maghrib: 'Maghrib',
            Isha: 'Isya'
        };

        Object.entries(prayers).forEach(([key, name]) => {
            if (schedule[key] !== currentTime) return;

            const firedId = `${today}_${key}`;

            if (localStorage.getItem(FIRED_KEY) === firedId) return;

            localStorage.setItem(FIRED_KEY, firedId);
            showPopup(name);
        });
    }

    function start() {
        if (timer) clearInterval(timer);

        createPopup();
        checkPrayerTime();

        timer = setInterval(checkPrayerTime, 15000);
    }

    // Dipanggil oleh app.js saat toggle diaktifkan
    window.PrayerNotif = {
        enableSystem: async function () {
            start();
            return 'unsupported';
        },

        close: function () {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }

            const popup = document.getElementById('prayerPopup');
            if (popup) popup.classList.remove('show');
        }
    };

    // Jika notifikasi sebelumnya sudah aktif
    document.addEventListener('DOMContentLoaded', function () {
        if (localStorage.getItem(ENABLED_KEY) === '1') {
            start();
        }
    });
})();
