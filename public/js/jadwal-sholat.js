document.addEventListener('DOMContentLoaded', function () {
    const getLocationButton = document.getElementById('getLocation');
    const locationName = document.getElementById('locationName');
    const statusMessage = document.getElementById('statusMessage');
    const currentDate = document.getElementById('currentDate');

    if (!getLocationButton || !locationName || !statusMessage) {
        console.error('Elemen Jadwal Sholat tidak ditemukan.');
        return;
    }

    // Menampilkan tanggal hari ini
    if (currentDate) {
        currentDate.textContent = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    // Mengambil jadwal sholat dari API
    async function getPrayerTimes(latitude, longitude) {
        try {
            statusMessage.textContent = 'Sedang mengambil jadwal sholat...';

            const response = await fetch(
                `https://api.aladhan.com/v1/timings?latitude=${latitude}&longitude=${longitude}&method=20&school=0`
            );

            if (!response.ok) {
                throw new Error('Gagal mengambil data jadwal.');
            }

            const result = await response.json();

            if (result.code !== 200) {
                throw new Error('Jadwal tidak tersedia.');
            }

            const timings = result.data.timings;
            localStorage.setItem(
                'sholatyuk_prayer_times',
                JSON.stringify({
                    Fajr: timings.Fajr.split(' ')[0],
                    Dhuhr: timings.Dhuhr.split(' ')[0],
                    Asr: timings.Asr.split(' ')[0],
                    Maghrib: timings.Maghrib.split(' ')[0],
                    Isha: timings.Isha.split(' ')[0]
                })
            );

            document.getElementById('fajr').textContent = timings.Fajr.split(' ')[0];
            document.getElementById('dhuhr').textContent = timings.Dhuhr.split(' ')[0];
            document.getElementById('asr').textContent = timings.Asr.split(' ')[0];
            document.getElementById('maghrib').textContent = timings.Maghrib.split(' ')[0];
            document.getElementById('isha').textContent = timings.Isha.split(' ')[0];

            statusMessage.textContent = 'Jadwal sholat berhasil dimuat!';

        } catch (error) {
            console.error(error);
            statusMessage.textContent = 'Gagal mengambil jadwal sholat. Silakan coba lagi.';
        }
    }

    // Tombol GPS
    getLocationButton.addEventListener('click', function () {
        if (!navigator.geolocation) {
            statusMessage.textContent = 'Browser tidak mendukung fitur lokasi.';
            return;
        }

        statusMessage.textContent = 'Sedang mengambil lokasi...';
        getLocationButton.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                locationName.textContent =
                    `Lokasi terdeteksi (${latitude.toFixed(4)}, ${longitude.toFixed(4)})`;

                getPrayerTimes(latitude, longitude).finally(() => {
                    getLocationButton.disabled = false;
                });
            },

            function (error) {
                if (error.code === error.PERMISSION_DENIED) {
                    statusMessage.textContent = 'Izin lokasi ditolak. Silakan izinkan akses GPS.';
                } else if (error.code === error.POSITION_UNAVAILABLE) {
                    statusMessage.textContent = 'Lokasi tidak tersedia.';
                } else {
                    statusMessage.textContent = 'Gagal mengambil lokasi. Silakan coba lagi.';
                }

                getLocationButton.disabled = false;
            },

            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    });
});
