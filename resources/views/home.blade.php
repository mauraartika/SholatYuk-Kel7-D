<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f7f7f2">

    <title>SholatYuk — Temani Setiap Waktu Sholat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap"
        rel="stylesheet">

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

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: var(--sans);
            -webkit-font-smoothing: antialiased;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .wrap {
            width: min(1120px, calc(100% - 48px));
            margin: auto;
        }

        /* NAVBAR */
        .topbar {
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(24, 37, 30, .08);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
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
            font-size: 19px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 32px;
            color: #4d5b52;
            font-size: 13px;
        }

        .nav a:hover {
            color: var(--green);
        }

        .nav-cta,
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            border-radius: 999px;
            padding: 13px 20px;
            background: var(--green);
            color: white;
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
        }

        .nav-cta:hover,
        .button:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        /* HERO */
        .hero {
            min-height: 650px;
            display: grid;
            grid-template-columns: 1.08fr .92fr;
            align-items: center;
            gap: 64px;
            padding: 78px 0 92px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .eyebrow:before {
            content: "";
            width: 26px;
            height: 1px;
            background: #78917e;
        }

        h1,
        h2,
        h3,
        p {
            margin-top: 0;
        }

        h1 {
            font: 600 clamp(46px, 5.4vw, 70px)/1.08 var(--serif);
            letter-spacing: -2.5px;
            max-width: 610px;
            margin-bottom: 23px;
        }

        h1 em {
            color: var(--green);
            font-style: normal;
        }

        .hero-copy {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.85;
            max-width: 485px;
            margin-bottom: 31px;
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 23px;
            flex-wrap: wrap;
        }

        .text-link {
            font-size: 13px;
            font-weight: 700;
            color: var(--green);
        }

        .trust {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 34px;
            color: #778078;
            font-size: 11px;
        }

        .trust-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #7a9b7d;
            box-shadow: 0 0 0 4px #e7eee5;
        }

        /* MOCKUP APLIKASI */
        .visual {
            position: relative;
            min-height: 485px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .orb {
            position: absolute;
            width: 410px;
            height: 410px;
            border-radius: 50%;
            background: #e9eee6;
            right: 4%;
            top: 5%;
        }

        .phone {
            position: relative;
            z-index: 2;
            width: 265px;
            min-height: 490px;
            border: 8px solid #202a23;
            border-radius: 39px;
            background: #fbfcf8;
            box-shadow: 0 30px 70px rgba(29, 47, 35, .18);
            padding: 18px 15px 16px;
            transform: rotate(3deg);
        }

        .phone-notch {
            width: 76px;
            height: 17px;
            background: #202a23;
            border-radius: 0 0 13px 13px;
            position: absolute;
            top: -1px;
            left: 50%;
            transform: translateX(-50%);
        }

        .app-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 2px 20px;
            font-size: 10px;
            color: #718075;
        }

        .app-logo {
            font-size: 13px;
            color: var(--green);
            font-weight: 700;
        }

        .location-pill {
            background: #edf2eb;
            border-radius: 20px;
            padding: 6px 9px;
            font-size: 9px;
        }

        .greeting {
            font-size: 10px;
            color: #829087;
            margin-bottom: 5px;
        }

        .app-date {
            font: 600 18px var(--serif);
            margin-bottom: 14px;
        }

        .next-card {
            background: var(--green);
            color: white;
            border-radius: 19px;
            padding: 17px;
            position: relative;
            overflow: hidden;
        }

        .next-card:after {
            content: "☾";
            position: absolute;
            right: 14px;
            top: 5px;
            color: rgba(255, 255, 255, .13);
            font-size: 75px;
        }

        .next-label {
            font-size: 9px;
            opacity: .75;
        }

        .next-name {
            font: 600 25px var(--serif);
            margin: 5px 0 1px;
        }

        .next-time {
            font-size: 21px;
            font-weight: 600;
        }

        .countdown {
            font-size: 9px;
            opacity: .75;
            margin-top: 8px;
        }

        .prayer-list {
            margin-top: 15px;
        }

        .prayer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 4px;
            border-bottom: 1px solid #edf0e9;
            font-size: 10px;
        }

        .prayer-row span:last-child {
            font-weight: 700;
        }

        .prayer-row.active {
            color: var(--green);
        }

        .phone-bottom {
            display: flex;
            justify-content: space-around;
            color: #8a968d;
            font-size: 8px;
            margin-top: 17px;
        }

        .phone-bottom b {
            color: var(--green);
        }

        .float-card {
            position: absolute;
            z-index: 3;
            background: white;
            border: 1px solid #edf0e9;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(30, 48, 36, .09);
            padding: 13px 16px;
        }

        .float-qibla {
            right: -2%;
            top: 19%;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .compass {
            width: 37px;
            height: 37px;
            border: 1px solid #dce6dc;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: var(--green);
            font-size: 19px;
        }

        .float-card strong {
            display: block;
            font-size: 11px;
        }

        .float-card small {
            display: block;
            color: #8a948d;
            font-size: 9px;
            margin-top: 3px;
        }

        .float-streak {
            left: -3%;
            bottom: 14%;
        }

        .float-streak strong {
            color: var(--green);
            font-size: 17px;
        }

        /* FITUR */
        .section {
            padding: 100px 0;
        }

        .section-head {
            max-width: 610px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .section-head .eyebrow {
            justify-content: center;
        }

        h2 {
            font: 600 clamp(34px, 4vw, 48px)/1.15 var(--serif);
            letter-spacing: -1.3px;
            margin-bottom: 15px;
        }

        .section-head p {
            color: var(--muted);
            line-height: 1.8;
            font-size: 14px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .feature {
            min-height: 220px;
            background: rgba(255, 255, 255, .72);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 27px;
            transition: .2s ease;
        }

        .feature:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 35px rgba(27, 47, 34, .06);
        }

        .feature-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            background: var(--mint);
            color: var(--green);
            border-radius: 14px;
            font-size: 20px;
            margin-bottom: 23px;
        }

        .feature h3 {
            font: 600 20px var(--serif);
            margin-bottom: 9px;
        }

        .feature p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            margin: 0;
        }

        /* TENTANG */
        .quiet {
            background: #edf1e9;
        }

        .quiet-inner {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: 70px;
            align-items: center;
        }

        .quiet h2 {
            max-width: 430px;
        }

        .quiet-copy {
            color: var(--muted);
            line-height: 1.9;
            font-size: 14px;
        }

        .benefits {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 23px 28px;
        }

        .benefit {
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .check {
            color: var(--green);
            font-size: 17px;
        }

        .benefit strong {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .benefit small {
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        /* CTA */
        .cta-section {
            padding: 92px 0;
            text-align: center;
        }

        .cta-panel {
            background: var(--green);
            color: white;
            border-radius: 24px;
            padding: 62px 25px;
            position: relative;
            overflow: hidden;
        }

        .cta-panel:before,
        .cta-panel:after {
            content: "✳";
            position: absolute;
            color: rgba(255, 255, 255, .08);
            font-size: 160px;
        }

        .cta-panel:before {
            left: 5%;
            top: -55px;
        }

        .cta-panel:after {
            right: 5%;
            bottom: -90px;
        }

        .cta-panel h2 {
            position: relative;
            z-index: 1;
            max-width: 570px;
            margin: 0 auto 15px;
        }

        .cta-panel p {
            position: relative;
            z-index: 1;
            color: rgba(255, 255, 255, .75);
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .cta-panel .button {
            position: relative;
            z-index: 1;
            background: white;
            color: var(--green);
        }

        /* FOOTER */
        footer {
            border-top: 1px solid var(--line);
            padding: 28px 0;
            color: #7d887f;
            font-size: 11px;
        }

        .footer-inner {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
        }

        .footer-brand {
            color: var(--ink);
            font-weight: 700;
        }

        /* RESPONSIVE */
        @media (max-width: 800px) {
            .nav {
                gap: 15px;
            }

            .nav a:not(.nav-cta) {
                display: none;
            }

            .hero {
                grid-template-columns: 1fr;
                gap: 30px;
                padding: 65px 0 60px;
                text-align: center;
            }

            .hero-copy {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-actions,
            .trust {
                justify-content: center;
            }

            .visual {
                min-height: 470px;
            }

            .orb {
                right: auto;
            }

            .float-qibla {
                right: 0;
            }

            .float-streak {
                left: 0;
            }

            .features {
                grid-template-columns: repeat(2, 1fr);
            }

            .quiet-inner {
                grid-template-columns: 1fr;
                gap: 35px;
            }
        }

        @media (max-width: 520px) {
            .wrap {
                width: min(100% - 32px, 1120px);
            }

            .topbar {
                height: 70px;
            }

            .nav-cta {
                padding: 11px 14px;
                font-size: 11px;
            }

            h1 {
                font-size: 48px;
                letter-spacing: -1.8px;
            }

            .hero {
                padding-top: 55px;
            }

            .visual {
                min-height: 430px;
                transform: scale(.91);
                margin: -10px -20px;
            }

            .phone {
                transform: scale(.9) rotate(3deg);
            }

            .orb {
                width: 340px;
                height: 340px;
            }

            .float-qibla {
                right: -1%;
                top: 15%;
            }

            .float-streak {
                left: -1%;
                bottom: 12%;
            }

            .features,
            .benefits {
                grid-template-columns: 1fr;
            }

            .section {
                padding: 72px 0;
            }

            .feature {
                min-height: auto;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .feature-link {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .feature-link .feature {
            height: 100%;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="wrap topbar">

        <a class="brand" href="{{ url('/') }}">
            <span class="brand-mark">☾</span>
            <span>SholatYuk</span>
        </a>

        <nav class="nav" aria-label="Navigasi utama">
            <a href="#fitur">Fitur</a>
            <a href="#tentang">Tentang</a>
            <a href="#mulai" class="nav-cta">
                Mulai Jelajahi ↗
            </a>
        </nav>

    </header>

    <main>

        <!-- HERO SECTION -->
        <section class="wrap hero">

            <div>

                <div class="eyebrow">
                    Teman ibadah sehari-hari
                </div>

                <h1>
                    Lebih dekat dengan waktu
                    <em>terbaikmu.</em>
                </h1>

                <p class="hero-copy">
                    Jaga ritme ibadah, temukan masjid di sekitarmu,
                    dan arahkan hati ke kiblat. Semua kebutuhan
                    ibadah harian dalam satu ruang yang tenang.
                </p>

                <div class="hero-actions">

                    <a class="button" href="#fitur">
                        Jelajahi fitur ↗
                    </a>

                    <a class="text-link" href="#tentang">
                        Kenali SholatYuk →
                    </a>

                </div>

                <div class="trust">
                    <span class="trust-dot"></span>
                    Dirancang untuk menemani perjalanan ibadahmu
                </div>

            </div>

            <!-- ILUSTRASI MOCKUP APLIKASI -->
            <div class="visual">

                <div class="orb"></div>

                <div class="phone">

                    <div class="phone-notch"></div>

                    <div class="app-top">
                        <span class="app-logo">☾ SholatYuk</span>
                        <span class="location-pill">⌖ Surabaya</span>
                    </div>

                    <p class="greeting">
                        Assalamu'alaikum,
                    </p>

                    <p class="app-date">
                        Selamat beribadah
                    </p>

                    <div class="next-card">

                        <div class="next-label">
                            WAKTU SHOLAT BERIKUTNYA
                        </div>

                        <div class="next-name">
                            Ashar
                        </div>

                        <div class="next-time">
                            15:08
                        </div>

                        <div class="countdown">
                            Waktu menuju sholat berikutnya
                        </div>

                    </div>

                    <div class="prayer-list">

                        <div class="prayer-row">
                            <span>Subuh</span>
                            <span>04:12</span>
                        </div>

                        <div class="prayer-row">
                            <span>Dzuhur</span>
                            <span>11:27</span>
                        </div>

                        <div class="prayer-row active">
                            <span>◉ Ashar</span>
                            <span>15:08</span>
                        </div>

                        <div class="prayer-row">
                            <span>Maghrib</span>
                            <span>17:25</span>
                        </div>

                        <div class="prayer-row">
                            <span>Isya</span>
                            <span>18:36</span>
                        </div>

                    </div>

                    <div class="phone-bottom">
                        <b>⌂ Beranda</b>
                        <span>◉ Kiblat</span>
                        <span>⌖ Masjid</span>
                        <span>☰ Lainnya</span>
                    </div>

                </div>

                <div class="float-card float-qibla">

                    <span class="compass">⌖</span>

                    <span>
                        <strong>Arah kiblat</strong>
                        <small>Temukan arah yang tepat</small>
                    </span>

                </div>

                <div class="float-card float-streak">

                    <small>Progress ibadah hari ini</small>
                    <strong>3 dari 5 sholat</strong>
                    <small>Terus jaga konsistensimu</small>

                </div>

            </div>

        </section>

        <!-- FITUR -->
        <section class="section" id="fitur">

            <div class="wrap">

                <div class="section-head">

                    <div class="eyebrow">
                        Satu aplikasi, banyak kemudahan
                    </div>

                    <h2>
                        Hal penting untuk ibadah, ada di sini.
                    </h2>

                    <p>
                        SholatYuk menyatukan pengingat, pencatatan,
                        dan berbagai utilitas ibadah dalam pengalaman
                        yang sederhana.
                    </p>

                </div>

                <div class="features">

                    <article class="feature">
                        <div class="feature-icon">◷</div>
                        <h3>Waktu sholat</h3>
                        <p>
                            Lihat jadwal sholat harian dan dapatkan
                            pengingat agar tidak melewatkan waktunya.
                        </p>
                    </article>

                    <a href="{{ url('/masjid-terdekat') }}" class="feature-link">
                        <article class="feature">
                            <div class="feature-icon">⌖</div>
                            <h3>Masjid terdekat</h3>
                            <p>
                                Temukan masjid di sekitar lokasi dan
                                lanjutkan dengan petunjuk arah menuju tujuan.
                            </p>
                        </article>
                    </a>

                    <a href="{{ url('arah-kiblat') }}" class="feature-link">
                        <article class="feature">
                            <div class="feature-icon">✥</div>
                            <h3>Arah kiblat</h3>
                            <p>
                                Gunakan kompas kiblat untuk membantu
                                menentukan arah menghadap Ka'bah.
                            </p>
                        </article>
                    </a>

                    <a href="{{ url('/pelacakan-ibadah') }}" class="feature-link">
                        <article class="feature">
                            <div class="feature-icon">✓</div>
                            <h3>Catatan ibadah</h3>
                            <p>
                                Pantau progres sholat wajib dan sunnah
                                serta catat ibadah harianmu.
                            </p>
                        </article>
                    </a>

                    <a href="{{ url('/sholat-sunnah') }}" class="feature-link">
                        <article class="feature">
                            <div class="feature-icon">☾</div>
                            <h3>Sholat Sunnah</h3>
                            <p>
                                Catat sholat sunnah yang telah dikerjakan
                                dan pantau konsistensi ibadah harianmu.
                            </p>
                        </article>
                    </a>

                    <article class="feature">
                        <div class="feature-icon">▥</div>
                        <h3>Statistik & progres</h3>
                        <p>
                            Pantau riwayat dan perkembangan ibadah
                            melalui ringkasan yang mudah dipahami.
                        </p>
                    </article>

                    <a href="{{ url('/leaderboard') }}" class="feature">
                        <div class="feature-icon">♧</div>
                        <h3>Komunitas & motivasi</h3>
                        <p>
                            Bangun semangat melalui streak, pencapaian, leaderboard
                            dan fitur sosial bersama teman.
                        </p>
                    </a>

                    <a href="/pengaturan-notifikasi" class="feature-link">
                        <article class="feature">
                            <div class="feature-icon">♫</div>
                            <h3>Adzan & pengingat</h3>
                            <p>
                                Atur pengingat dan pilihan audio adzan
                                untuk menemani waktu-waktu sholat.
                            </p>
                        </article>
                    </a>

                    <article class="feature">
                        <div class="feature-icon">☾</div>
                        <h3>Kalender Hijriah</h3>
                        <p>
                            Kenali tanggal Hijriah dan momen penting
                            dalam kalender Islam.
                        </p>
                    </article>

                    <article class="feature">
                        <div class="feature-icon">۞</div>
                        <h3>Al-Qur'an</h3>
                        <p>
                            Akses ruang baca Al-Qur'an sebagai bagian
                            dari perjalanan ibadah harian.
                        </p>
                    </article>

                </div>

            </div>

        </section>

        <!-- TENTANG -->
        <section class="section quiet" id="tentang">

            <div class="wrap quiet-inner">

                <div>

                    <div class="eyebrow">
                        Sederhana dan bermakna
                    </div>

                    <h2>
                        Lebih sedikit distraksi.
                        Lebih banyak ruang untuk beribadah.
                    </h2>

                    <p class="quiet-copy">
                        Kami ingin menghadirkan pengalaman yang jelas
                        dan nyaman, supaya kamu bisa fokus pada hal
                        yang paling penting: menjaga hubungan dengan
                        Allah melalui ibadah sehari-hari.
                    </p>

                </div>

                <div class="benefits">

                    <div class="benefit">
                        <span class="check">✓</span>
                        <span>
                            <strong>Mudah digunakan</strong>
                            <small>
                                Navigasi ringkas untuk menemukan
                                fitur yang dibutuhkan.
                            </small>
                        </span>
                    </div>

                    <div class="benefit">
                        <span class="check">✓</span>
                        <span>
                            <strong>Informasi terarah</strong>
                            <small>
                                Jadwal, progres, dan utilitas
                                ibadah tersusun rapi.
                            </small>
                        </span>
                    </div>

                    <div class="benefit">
                        <span class="check">✓</span>
                        <span>
                            <strong>Teman perjalanan</strong>
                            <small>
                                Dukung kebiasaan baik dari
                                hari ke hari.
                            </small>
                        </span>
                    </div>

                    <div class="benefit">
                        <span class="check">✓</span>
                        <span>
                            <strong>Dalam satu tempat</strong>
                            <small>
                                Beragam kebutuhan ibadah harian
                                dalam satu aplikasi.
                            </small>
                        </span>
                    </div>

                </div>

            </div>

        </section>

        <!-- CTA -->
        <section class="wrap cta-section" id="mulai">

            <div class="cta-panel">

                <div class="eyebrow" style="color:#dce8dc;justify-content:center">
                    Mulai dari langkah kecil
                </div>

                <h2>
                    Yuk, jaga ibadah hari ini bersama SholatYuk.
                </h2>

                <p>
                    Temukan fitur yang kamu perlukan dan mulai
                    bangun rutinitas ibadah yang lebih teratur.
                </p>

                <a class="button" href="#fitur">
                    Lihat semua fitur ↗
                </a>

            </div>

        </section>

    </main>

    <!-- FOOTER -->
    <footer>

        <div class="wrap footer-inner">

            <span class="footer-brand">
                ☾ SholatYuk
            </span>

            <span>
                Temani setiap langkah menuju ibadah yang lebih baik.
            </span>

            <span>
                © {{ date('Y') }} SholatYuk
            </span>

        </div>

    </footer>

</body>

</html>
