
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masjid Terdekat - SholatYuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        :root {
            --green: #315c46;
            --dark: #1d3026;
            --cream: #f7f7f2;
            --white: #ffffff;
            --muted: #78847c;
            --line: #e8ebe5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--dark);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            height: 76px;
            padding: 0 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            font-size: 23px;
            font-weight: 800;
            color: var(--green);
        }

        .brand span {
            color: #b18a54;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
            color: #66736a;
        }

        .nav-links a:hover,
        .nav-links .active {
            color: var(--green);
        }

        .back-link {
            padding: 10px 17px;
            border: 1px solid var(--line);
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
        }

        .container {
            max-width: 1250px;
            margin: auto;
            padding: 48px 24px 70px;
        }

        .heading {
            margin-bottom: 28px;
        }

        .eyebrow {
            color: #a17b49;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 48px);
            line-height: 1.15;
            margin-bottom: 12px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
            max-width: 600px;
        }

        .location-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px 20px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 16px;
            margin-bottom: 22px;
        }

        .location-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .location-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            background: #edf3ed;
            border-radius: 13px;
            font-size: 21px;
        }

        .location-info strong {
            display: block;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .location-info small {
            color: var(--muted);
            font-size: 12px;
        }

        button, select {
            font-family: inherit;
        }

        .primary-btn {
            border: none;
            border-radius: 30px;
            background: var(--green);
            color: white;
            padding: 12px 19px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .primary-btn:hover {
            background: var(--dark);
            transform: translateY(-1px);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 390px 1fr;
            gap: 22px;
            align-items: stretch;
        }

        .panel {
            background: white;
            border: 1px solid var(--line);
            border-radius: 19px;
            overflow: hidden;
        }

        .panel-header {
            padding: 21px;
            border-bottom: 1px solid var(--line);
        }

        .panel-header h2 {
            font-size: 17px;
            margin-bottom: 6px;
        }

        .panel-header p {
            color: var(--muted);
            font-size: 12px;
        }

        .filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 17px;
        }

        .filter-row label {
            font-size: 12px;
            font-weight: 700;
        }

        .filter-row select {
            border: 1px solid var(--line);
            border-radius: 9px;
            padding: 9px 12px;
            background: white;
            color: var(--dark);
            outline: none;
            font-size: 12px;
        }

        .mosque-list {
            padding: 10px;
            max-height: 570px;
            overflow-y: auto;
        }

        .mosque-card {
            padding: 16px 13px;
            border-bottom: 1px solid #f0f1ed;
            transition: .2s;
        }

        .mosque-card:last-child {
            border-bottom: none;
        }

        .mosque-card:hover {
            background: #f8faf7;
            border-radius: 12px;
        }

        .mosque-top {
            display: flex;
            gap: 12px;
        }

        .mosque-icon {
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            background: #edf3ed;
            display: grid;
            place-items: center;
            font-size: 21px;
        }

        .mosque-details {
            flex: 1;
            min-width: 0;
        }

        .mosque-details h3 {
            font-size: 14px;
            line-height: 1.4;
            margin-bottom: 5px;
        }

        .mosque-details p {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .distance {
            display: inline-block;
            color: var(--green);
            background: #edf3ed;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 800;
            margin-top: 9px;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 13px;
        }

        .card-actions button,
        .card-actions a {
            border: 1px solid var(--line);
            background: white;
            padding: 8px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            color: var(--green);
        }

        .card-actions .direction {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .map-panel {
            position: relative;
            min-height: 620px;
        }

        #map {
            width: 100%;
            height: 100%;
            min-height: 620px;
            z-index: 1;
        }

        .map-label {
            position: absolute;
            z-index: 500;
            top: 15px;
            left: 15px;
            background: white;
            padding: 11px 15px;
            border-radius: 12px;
            box-shadow: 0 3px 15px #00000012;
            font-size: 12px;
            font-weight: 700;
        }

        .status {
            padding: 16px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .empty {
            text-align: center;
            padding: 35px 20px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .empty span {
            display: block;
            font-size: 30px;
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: var(--muted);
            font-size: 12px;
        }

        @media (max-width: 850px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .map-panel {
                min-height: 420px;
                order: -1;
            }

            #map {
                min-height: 420px;
            }

            .mosque-list {
                max-height: 450px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                display: none;
            }

            .container {
                padding: 35px 15px 50px;
            }

            .location-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .location-bar .primary-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <a href="{{ url('/') }}" class="brand">Sholat<span>Yuk.</span></a>

    <div class="nav-links">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="#" class="active">Masjid Terdekat</a>
        <a href="{{ url('/kiblat') }}">Arah Kiblat</a>
    </div>

    <a href="{{ url('/') }}" class="back-link">← Kembali</a>
</nav>

<main class="container">

    <section class="heading">
        <div class="eyebrow">Location Utilities</div>
        <h1>Temukan masjid<br>di sekitarmu.</h1>
        <p class="subtitle">
            Temukan masjid terdekat dari lokasimu dan dapatkan petunjuk
            arah agar perjalanan menuju tempat ibadah jadi lebih mudah.
        </p>
    </section>

    <section class="location-bar">
        <div class="location-info">
            <div class="location-icon">📍</div>
            <div>
                <strong>Lokasi kamu</strong>
                <small id="locationText">Lokasi belum terdeteksi</small>
            </div>
        </div>

        <button class="primary-btn" onclick="getUserLocation()">
            Gunakan Lokasi Saya
        </button>
    </section>

    <section class="content-grid">

        <div class="panel">
            <div class="panel-header">
                <h2>Masjid di Sekitarmu</h2>
                <p id="resultCount">Temukan tempat ibadah terdekat</p>

                <div class="filter-row">
                    <label for="radius">Radius pencarian</label>
                    <select id="radius" onchange="searchMosques()">
                        <option value="1000">1 Kilometer</option>
                        <option value="3000" selected>3 Kilometer</option>
                        <option value="5000">5 Kilometer</option>
                        <option value="10000">10 Kilometer</option>
                    </select>
                </div>
            </div>

            <div id="mosqueList" class="mosque-list">
                <div class="empty">
                    <span>🕌</span>
                    Klik tombol "Gunakan Lokasi Saya" untuk mencari
                    masjid di sekitarmu.
                </div>
            </div>

            <div class="status" id="status">
                Data lokasi menggunakan OpenStreetMap.
            </div>
        </div>

        <div class="panel map-panel">
            <div class="map-label">🗺️ Peta Masjid Terdekat</div>
            <div id="map"></div>
        </div>

    </section>
</main>

<footer class="footer">
    © {{ date('Y') }} SholatYuk — Temani perjalanan ibadahmu.
</footer>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    let userLat = null;
    let userLng = null;
    let map;
    let mosqueMarkers = [];
    let userMarker = null;
    let mosqueData = [];

    // Inisialisasi peta
    map = L.map('map').setView([-7.2575, 112.7521], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Icon lokasi pengguna
    const userIcon = L.divIcon({
        className: '',
        html: '<div style="background:#315c46;color:white;border:3px solid white;border-radius:50%;width:25px;height:25px;box-shadow:0 2px 8px #0005"></div>',
        iconSize: [25, 25],
        iconAnchor: [12, 12]
    });

    // Icon masjid
    const mosqueIcon = L.divIcon({
        className: '',
        html: '<div style="background:#fff;border:2px solid #315c46;border-radius:50%;width:35px;height:35px;display:grid;place-items:center;font-size:19px;box-shadow:0 2px 8px #0003">🕌</div>',
        iconSize: [35, 35],
        iconAnchor: [17, 17]
    });

    function getUserLocation() {
        const status = document.getElementById('status');

        if (!navigator.geolocation) {
            status.textContent = 'Browser kamu tidak mendukung fitur lokasi.';
            return;
        }

        status.textContent = 'Sedang mendeteksi lokasi kamu...';

        navigator.geolocation.getCurrentPosition(
            function(position) {
                userLat = position.coords.latitude;
                userLng = position.coords.longitude;

                document.getElementById('locationText').textContent =
                    userLat.toFixed(5) + ', ' + userLng.toFixed(5);

                map.setView([userLat, userLng], 15);

                if (userMarker) {
                    map.removeLayer(userMarker);
                }

                userMarker = L.marker([userLat, userLng], {
                    icon: userIcon
                }).addTo(map);

                userMarker.bindPopup('Lokasi kamu').openPopup();

                searchMosques();
            },
            function(error) {
                let message = 'Tidak dapat mengakses lokasi.';

                if (error.code === 1) {
                    message = 'Izin lokasi ditolak. Izinkan akses lokasi di browser.';
                } else if (error.code === 2) {
                    message = 'Lokasi tidak tersedia. Coba lagi.';
                } else if (error.code === 3) {
                    message = 'Waktu deteksi lokasi habis. Coba lagi.';
                }

                status.textContent = message;
            },
            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    }

    async function searchMosques() {
        if (userLat === null || userLng === null) {
            return;
        }

        const radius = document.getElementById('radius').value;
        const list = document.getElementById('mosqueList');
        const status = document.getElementById('status');

        list.innerHTML = '<div class="empty">Sedang mencari masjid terdekat...</div>';
        status.textContent = 'Mengambil data masjid dari OpenStreetMap...';

        const query = `
            [out:json][timeout:25];
            (
                nwr["amenity"="place_of_worship"]["religion"="muslim"](around:${radius},${userLat},${userLng});
                nwr["building"="mosque"](around:${radius},${userLat},${userLng});
            );
            out center tags;
        `;

        try {
            const response = await fetch(
                'https://overpass-api.de/api/interpreter',
                {
                    method: 'POST',
                    body: 'data=' + encodeURIComponent(query)
                }
            );

            if (!response.ok) {
                throw new Error('Gagal mengambil data masjid.');
            }

            const data = await response.json();

            mosqueData = data.elements.map(item => {
                const lat = item.lat ?? item.center?.lat;
                const lng = item.lon ?? item.center?.lon;

                if (lat == null || lng == null) return null;

                const distance = calculateDistance(
                    userLat, userLng, lat, lng
                );

                return {
                    id: item.id,
                    lat: lat,
                    lng: lng,
                    name: item.tags?.name || 'Masjid tanpa nama',
                    address: item.tags?.['addr:street'] || 'Alamat belum tersedia',
                    distance: distance
                };
            })
            .filter(Boolean)
            .sort((a, b) => a.distance - b.distance);

            displayMosques();
        } catch (error) {
            list.innerHTML = `
                <div class="empty">
                    <span>⚠️</span>
                    Data masjid gagal dimuat.<br>
                    Periksa koneksi internet lalu coba lagi.
                </div>
            `;
            status.textContent = error.message;
        }
    }

    function displayMosques() {
        const list = document.getElementById('mosqueList');
        const resultCount = document.getElementById('resultCount');
        const status = document.getElementById('status');

        mosqueMarkers.forEach(marker => map.removeLayer(marker));
        mosqueMarkers = [];

        resultCount.textContent = mosqueData.length + ' masjid ditemukan';

        if (mosqueData.length === 0) {
            list.innerHTML = `
                <div class="empty">
                    <span>🕌</span>
                    Belum ada data masjid dalam radius ini.
                    Coba perluas radius pencarian.
                </div>
            `;
            status.textContent = 'Coba pilih radius pencarian yang lebih luas.';
            return;
        }

        list.innerHTML = '';

        mosqueData.forEach((mosque, index) => {
            const distanceText = mosque.distance < 1
                ? Math.round(mosque.distance * 1000) + ' meter'
                : mosque.distance.toFixed(2) + ' km';

            const card = document.createElement('article');
            card.className = 'mosque-card';

            const top = document.createElement('div');
            top.className = 'mosque-top';

            const icon = document.createElement('div');
            icon.className = 'mosque-icon';
            icon.textContent = '🕌';

            const details = document.createElement('div');
            details.className = 'mosque-details';

            const name = document.createElement('h3');
            name.textContent = mosque.name;

            const address = document.createElement('p');
            address.textContent = mosque.address;

            const distance = document.createElement('span');
            distance.className = 'distance';
            distance.textContent = '📍 ' + distanceText;

            details.append(name, address, distance);
            top.append(icon, details);

            const actions = document.createElement('div');
            actions.className = 'card-actions';

            const viewButton = document.createElement('button');
            viewButton.textContent = 'Lihat di Peta';
            viewButton.onclick = () => {
                map.setView([mosque.lat, mosque.lng], 17);
                mosqueMarkers[index].openPopup();
            };

            const directionLink = document.createElement('a');
            directionLink.className = 'direction';
            directionLink.textContent = 'Petunjuk Arah';
            directionLink.href =
                `https://www.google.com/maps/dir/?api=1&destination=${mosque.lat},${mosque.lng}`;
            directionLink.target = '_blank';
            directionLink.rel = 'noopener';

            actions.append(viewButton, directionLink);
            card.append(top, actions);
            list.appendChild(card);

            const marker = L.marker(
                [mosque.lat, mosque.lng],
                { icon: mosqueIcon }
            ).addTo(map);

            marker.bindPopup(
                `<strong>${escapeHtml(mosque.name)}</strong><br>${distanceText}`
            );

            mosqueMarkers.push(marker);
        });

        status.textContent = 'Menampilkan ' + mosqueData.length +
            ' masjid berdasarkan data OpenStreetMap.';
    }

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const earthRadius = 6371;
        const toRad = value => value * Math.PI / 180;

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);

        const a =
            Math.sin(dLat / 2) ** 2 +
            Math.cos(toRad(lat1)) *
            Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) ** 2;

        return earthRadius * 2 *
            Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    }

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, character => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[character]);
    }
</script>

</body>
</html>
