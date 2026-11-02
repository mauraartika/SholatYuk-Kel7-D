
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arah Kiblat - SholatYuk</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --green: #315c46;
            --dark: #1d3026;
            --cream: #f7f7f2;
            --white: #ffffff;
            --muted: #78847c;
            --line: #e8ebe5;
            --gold: #b18a54;
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
            color: var(--gold);
        }

        .nav-links {
            display: flex;
            gap: 30px;
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
            max-width: 1100px;
            margin: auto;
            padding: 50px 24px 75px;
        }

        .heading {
            text-align: center;
            margin-bottom: 35px;
        }

        .eyebrow {
            color: var(--gold);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
            margin-bottom: 13px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(34px, 5vw, 48px);
            margin-bottom: 13px;
        }

        .subtitle {
            color: var(--muted);
            max-width: 570px;
            margin: auto;
            font-size: 14px;
            line-height: 1.8;
        }

        .compass-card {
            max-width: 720px;
            margin: auto;
            padding: 35px 25px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(30, 50, 38, .04);
        }

        .location-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 15px;
            background: #edf3ed;
            color: var(--green);
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .compass {
            width: min(310px, 75vw);
            aspect-ratio: 1;
            margin: 0 auto 30px;
            position: relative;
            border-radius: 50%;
            border: 10px solid #edf2eb;
            background:
                radial-gradient(circle, #ffffff 0 55%, #f5f7f1 56% 100%);
            box-shadow:
                0 0 0 1px #dfe7dc,
                0 15px 35px rgba(30, 50, 38, .09);
        }

        .compass::before {
            content: '';
            position: absolute;
            inset: 14px;
            border: 1px dashed #cbd7ca;
            border-radius: 50%;
        }

        .direction {
            position: absolute;
            font-size: 14px;
            font-weight: 800;
            color: var(--muted);
        }

        .north {
            top: 13px;
            left: 50%;
            transform: translateX(-50%);
            color: #bd735b;
        }

        .south {
            bottom: 13px;
            left: 50%;
            transform: translateX(-50%);
        }

        .east {
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
        }

        .west {
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
        }

        .needle {
            position: absolute;
            width: 100%;
            height: 100%;
            inset: 0;
            transform: rotate(0deg);
            transition: transform .5s ease;
        }

        .needle::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 18%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 12px solid transparent;
            border-right: 12px solid transparent;
            border-bottom: 105px solid var(--green);
            filter: drop-shadow(0 3px 3px #0002);
        }

        .needle::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--gold);
            border: 4px solid white;
            box-shadow: 0 2px 8px #0002;
        }

        .kaaba {
            position: absolute;
            left: 50%;
            top: 18%;
            transform: translate(-50%, -50%);
            font-size: 25px;
            z-index: 2;
        }

        .degree {
            font-family: 'Playfair Display', serif;
            font-size: 43px;
            color: var(--green);
            margin-bottom: 5px;
        }

        .degree-label {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 24px;
        }

        .main-btn {
            background: var(--green);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .main-btn:hover {
            background: var(--dark);
            transform: translateY(-2px);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 720px;
            margin: 20px auto 0;
        }

        .info-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 17px;
            padding: 20px 15px;
            text-align: center;
        }

        .info-card .icon {
            font-size: 23px;
            margin-bottom: 9px;
        }

        .info-card h3 {
            font-size: 12px;
            color: var(--muted);
            margin-bottom: 7px;
        }

        .info-card p {
            font-size: 14px;
            font-weight: 800;
            color: var(--green);
        }

        .guide {
            max-width: 720px;
            margin: 28px auto 0;
            background: #edf3ed;
            padding: 22px;
            border-radius: 18px;
        }

        .guide h3 {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .guide p {
            color: #617267;
            font-size: 13px;
            line-height: 1.8;
        }

        .message {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
            margin-top: 17px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: var(--muted);
            font-size: 12px;
        }

        @media(max-width: 650px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                display: none;
            }

            .container {
                padding: 35px 15px 55px;
            }

            .compass-card {
                padding: 28px 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <a href="{{ url('/') }}" class="brand">Sholat<span>Yuk.</span></a>

    <div class="nav-links">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ url('/masjid-terdekat') }}">Masjid Terdekat</a>
        <a href="#" class="active">Arah Kiblat</a>
    </div>

    <a href="{{ url('/') }}" class="back-link">← Kembali</a>
</nav>

<main class="container">

    <section class="heading">
        <div class="eyebrow">Location Utilities</div>
        <h1>Temukan arah kiblatmu.</h1>
        <p class="subtitle">
            Ketahui arah Ka'bah dari lokasimu saat ini melalui kompas
            kiblat SholatYuk. Pastikan kamu mengaktifkan lokasi perangkat
            untuk mendapatkan hasil yang sesuai.
        </p>
    </section>

    <section class="compass-card">

        <div class="location-status">
            📍 <span id="locationText">Lokasi belum terdeteksi</span>
        </div>

        <div class="compass">
            <span class="direction north">N</span>
            <span class="direction east">E</span>
            <span class="direction south">S</span>
            <span class="direction west">W</span>

            <div class="needle" id="needle"></div>
            <div class="kaaba">🕋</div>
        </div>

        <div class="degree" id="degree">--°</div>
        <div class="degree-label">Arah kiblat dari utara sejati</div>

        <button class="main-btn" onclick="getLocation()">
            Aktifkan Kompas Kiblat
        </button>

        <p class="message" id="message">
            Tekan tombol untuk mendeteksi lokasi dan menghitung arah kiblat.
        </p>

    </section>

    <section class="info-grid">

        <div class="info-card">
            <div class="icon">🧭</div>
            <h3>Arah Kiblat</h3>
            <p id="directionValue">Belum tersedia</p>
        </div>

        <div class="info-card">
            <div class="icon">📍</div>
            <h3>Koordinat Lokasi</h3>
            <p id="coordinateValue">Belum tersedia</p>
        </div>

        <div class="info-card">
            <div class="icon">🕋</div>
            <h3>Tujuan Kiblat</h3>
            <p>Makkah, Arab Saudi</p>
        </div>

    </section>

    <section class="guide">
        <h3>✦ Cara menggunakan kompas kiblat</h3>
        <p>
            1. Aktifkan layanan lokasi pada perangkatmu.<br>
            2. Tekan tombol "Aktifkan Kompas Kiblat".<br>
            3. Izinkan browser mengakses lokasi perangkat.<br>
            4. Arahkan perangkat mengikuti kompas dan sesuaikan
            orientasinya. Jauhkan perangkat dari benda bermagnet
            agar hasil sensor lebih stabil.
        </p>
    </section>

</main>

<footer class="footer">
    © {{ date('Y') }} SholatYuk — Temani perjalanan ibadahmu.
</footer>

<script>
    const kaabaLat = 21.4225;
    const kaabaLng = 39.8262;

    let userLat = null;
    let userLng = null;
    let qiblaBearing = null;
    let deviceHeading = 0;

    function calculateQibla(lat1, lon1) {
        const toRad = deg => deg * Math.PI / 180;
        const toDeg = rad => rad * 180 / Math.PI;

        const phi1 = toRad(lat1);
        const phi2 = toRad(kaabaLat);
        const deltaLambda = toRad(kaabaLng - lon1);

        const y = Math.sin(deltaLambda);
        const x = Math.cos(phi1) * Math.tan(phi2)
            - Math.sin(phi1) * Math.cos(deltaLambda);

        let bearing = toDeg(Math.atan2(y, x));

        return (bearing + 360) % 360;
    }

    function getDirection(degree) {
        const directions = [
            'Utara', 'Timur Laut', 'Timur', 'Tenggara',
            'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'
        ];

        return directions[Math.round(degree / 45) % 8];
    }

    function getLocation() {
        const message = document.getElementById('message');

        if (!navigator.geolocation) {
            message.textContent =
                'Browser tidak mendukung fitur lokasi.';
            return;
        }

        message.textContent = 'Sedang mendeteksi lokasi...';

        navigator.geolocation.getCurrentPosition(
            function(position) {
                userLat = position.coords.latitude;
                userLng = position.coords.longitude;

                qiblaBearing = calculateQibla(userLat, userLng);

                document.getElementById('locationText').textContent =
                    'Lokasi berhasil terdeteksi';

                document.getElementById('degree').textContent =
                    qiblaBearing.toFixed(1) + '°';

                document.getElementById('directionValue').textContent =
                    getDirection(qiblaBearing);

                document.getElementById('coordinateValue').textContent =
                    userLat.toFixed(3) + ', ' + userLng.toFixed(3);

                updateCompass();

                message.textContent =
                    'Arah kiblat berhasil dihitung. Aktifkan sensor kompas jika perangkat mendukungnya.';

                startCompass();
            },
            function(error) {
                if (error.code === 1) {
                    message.textContent =
                        'Izin lokasi ditolak. Aktifkan izin lokasi di browser.';
                } else {
                    message.textContent =
                        'Lokasi tidak dapat dideteksi. Silakan coba lagi.';
                }
            },
            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        );
    }

    function updateCompass() {
        if (qiblaBearing === null) return;

        const rotation = qiblaBearing - deviceHeading;

        document.getElementById('needle').style.transform =
            `rotate(${rotation}deg)`;
    }

    function startCompass() {
        if (!window.DeviceOrientationEvent) {
            document.getElementById('message').textContent =
                'Sensor kompas tidak tersedia di perangkat ini. Sudut kiblat tetap dapat dilihat.';
            return;
        }

        if (typeof DeviceOrientationEvent.requestPermission === 'function') {
            DeviceOrientationEvent.requestPermission()
                .then(permission => {
                    if (permission === 'granted') {
                        window.addEventListener(
                            'deviceorientation',
                            handleOrientation,
                            true
                        );
                    } else {
                        document.getElementById('message').textContent =
                            'Izin sensor kompas tidak diberikan. Sudut kiblat tetap tersedia.';
                    }
                })
                .catch(() => {
                    document.getElementById('message').textContent =
                        'Sensor kompas tidak dapat diaktifkan pada perangkat ini.';
                });
        } else {
            window.addEventListener(
                'deviceorientationabsolute',
                handleOrientation,
                true
            );

            window.addEventListener(
                'deviceorientation',
                handleOrientation,
                true
            );
        }
    }

    function handleOrientation(event) {
        let heading = null;

        if (typeof event.webkitCompassHeading === 'number') {
            heading = event.webkitCompassHeading;
        } else if (event.absolute && typeof event.alpha === 'number') {
            heading = 360 - event.alpha;
        }

        if (heading !== null) {
            deviceHeading = heading;
            updateCompass();
        }
    }
</script>

</body>
</html>
