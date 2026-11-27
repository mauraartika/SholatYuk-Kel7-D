
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f7f7f2">

    <title>Jadwal Sholat — SholatYuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --paper: #f7f7f2;
            --ink: #18251e;
            --muted: #68736b;
            --green: #315c46;
            --green-dark: #214633;
            --mint: #e8eee7;
            --line: #e4e7df;
            --white: #fff;
            --serif: "Playfair Display", Georgia, serif;
            --sans: "DM Sans", Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: var(--sans);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .wrap {
            width: min(900px, calc(100% - 40px));
            margin: auto;
        }

        .topbar {
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--line);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 20px;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            color: white;
            background: var(--green);
        }

        .back-link {
            color: var(--green);
            font-size: 13px;
            font-weight: 700;
        }

        main {
            padding: 55px 0 80px;
        }

        .heading {
            text-align: center;
            margin-bottom: 32px;
        }

        .eyebrow {
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 13px;
        }

        h1 {
            font: 600 clamp(34px, 5vw, 46px)/1.2 var(--serif);
            margin: 0 0 12px;
        }

        .heading p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .location-card {
            background: var(--green);
            color: white;
            padding: 25px;
            border-radius: 20px;
            margin-bottom: 25px;
        }

        .location-label {
            font-size: 11px;
            opacity: .75;
            margin-bottom: 8px;
        }

        .location-name {
            font: 600 24px var(--serif);
            margin-bottom: 16px;
        }

        .location-button {
            border: 1px solid rgba(255,255,255,.5);
            background: transparent;
            color: white;
            border-radius: 30px;
            padding: 10px 16px;
            font: 600 11px var(--sans);
            cursor: pointer;
        }

        .location-button:hover {
            background: rgba(255,255,255,.12);
        }

        .date-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .date-card span {
            color: var(--muted);
            font-size: 12px;
        }

        .date-card strong {
            font-size: 13px;
        }

        .schedule-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 25px;
        }

        .schedule-card h2 {
            font: 600 22px var(--serif);
            margin: 0 0 20px;
        }

        .prayer-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 17px 5px;
            border-bottom: 1px solid #edf0e9;
            font-size: 14px;
        }

        .prayer-row:last-child {
            border-bottom: none;
        }

        .prayer-row strong {
            font-size: 15px;
        }

        .prayer-row.active {
            color: var(--green);
            background: var(--mint);
            border-radius: 12px;
            padding-left: 15px;
            padding-right: 15px;
            font-weight: 700;
        }

        .status {
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            margin-top: 18px;
            line-height: 1.7;
        }

        @media (max-width: 520px) {
            .topbar {
                height: 70px;
            }

            main {
                padding-top: 40px;
            }

            .location-card,
            .schedule-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <header class="wrap topbar">
        <a class="brand" href="{{ url('/') }}">
            <span class="brand-mark">☾</span>
            <span>SholatYuk</span>
        </a>

        <a href="{{ url('/') }}" class="back-link">
            ← Kembali
        </a>
    </header>

    <main class="wrap">

        <section class="heading">
            <div class="eyebrow">Jadwal ibadah harian</div>
            <h1>Waktu Sholat</h1>
            <p>Ketahui waktu sholat dan jaga konsistensi ibadahmu.</p>
        </section>

        <section class="location-card">
            <div class="location-label">LOKASI SAAT INI</div>
            <div class="location-name" id="locationName">
                Lokasi belum terdeteksi
            </div>

            <button class="location-button" id="getLocation">
                ⌖ Gunakan Lokasi GPS
            </button>
        </section>

        <section class="date-card">
            <span>Tanggal hari ini</span>
            <strong id="currentDate">Memuat tanggal...</strong>
        </section>

        <section class="schedule-card">
            <h2>Jadwal Sholat Hari Ini</h2>

            <div class="prayer-row">
                <span>Subuh</span>
                <strong id="fajr">--:--</strong>
            </div>

            <div class="prayer-row">
                <span>Dzuhur</span>
                <strong id="dhuhr">--:--</strong>
            </div>

            <div class="prayer-row">
                <span>Ashar</span>
                <strong id="asr">--:--</strong>
            </div>

            <div class="prayer-row">
                <span>Maghrib</span>
                <strong id="maghrib">--:--</strong>
            </div>

            <div class="prayer-row">
                <span>Isya</span>
                <strong id="isha">--:--</strong>
            </div>
        </section>

        <p class="status" id="statusMessage">
            Tekan tombol GPS untuk mendapatkan jadwal sholat sesuai lokasimu.
        </p>

    </main>

    <script>
        document.getElementById('currentDate').textContent =
            new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
    </script>

    <script src="{{ asset('js/jadwal-sholat.js') }}" defer></script>
    <script src="{{ asset('js/prayer-notif.js') }}"></script>

</body>
</html>
