<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f7f7f2">
    <title>Leaderboard — SholatYuk</title>

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
            width: min(1000px, calc(100% - 40px));
            margin: auto;
        }

        /* NAVBAR */
        .topbar {
            height: 78px;
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
            font-size: 19px;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            background: var(--green);
            color: white;
            font-size: 19px;
        }

        .back-link {
            color: var(--green);
            font-size: 13px;
            font-weight: 700;
        }

        /* HEADER */
        .page-header {
            text-align: center;
            padding: 65px 0 35px;
        }

        .eyebrow {
            color: var(--green);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        h1 {
            font: 600 clamp(35px, 5vw, 52px)/1.15 var(--serif);
            letter-spacing: -1.5px;
            margin: 0 0 15px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
            max-width: 520px;
            margin: auto;
        }

        /* PERIOD FILTER */
        .period {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin: 28px 0 45px;
        }

        .period a {
            padding: 10px 19px;
            border: 1px solid var(--line);
            border-radius: 30px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .period a.active {
            background: var(--green);
            border-color: var(--green);
            color: white;
        }

        /* PODIUM */
        .podium {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            align-items: end;
            gap: 15px;
            max-width: 720px;
            margin: 0 auto 65px;
        }

        .podium-card {
            text-align: center;
            background: white;
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 25px 12px;
        }

        .podium-card.first {
            padding-top: 38px;
            padding-bottom: 38px;
            background: #edf2e9;
            border-color: #d8e2d6;
        }

        .medal {
            font-size: 28px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 57px;
            height: 57px;
            margin: 0 auto 12px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--mint);
            color: var(--green);
            font-size: 21px;
            font-weight: 700;
        }

        .first .avatar {
            width: 68px;
            height: 68px;
            background: var(--green);
            color: white;
            font-size: 25px;
        }

        .podium-card h3 {
            font-size: 13px;
            margin: 0 0 6px;
        }

        .points {
            color: var(--green);
            font-size: 13px;
            font-weight: 700;
        }

        .podium-card small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-top: 5px;
        }

        /* RANKING */
        .ranking-section {
            max-width: 760px;
            margin: auto;
            padding-bottom: 80px;
        }

        .section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-title h2 {
            font: 600 25px var(--serif);
            margin: 0;
        }

        .section-title span {
            color: var(--muted);
            font-size: 11px;
        }

        .ranking-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .ranking-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 17px 20px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 14px;
        }

        .ranking-item.me {
            background: #edf2e9;
            border-color: #b9cdb9;
        }

        .rank-number {
            width: 28px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
            text-align: center;
        }

        .rank-avatar {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--mint);
            color: var(--green);
            font-weight: 700;
        }

        .rank-info {
            flex: 1;
        }

        .rank-info strong {
            display: block;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .rank-info small {
            color: var(--muted);
            font-size: 11px;
        }

        .rank-points {
            color: var(--green);
            font-size: 13px;
            font-weight: 700;
            text-align: right;
        }

        .rank-points small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 400;
            margin-top: 4px;
        }

        .leaderboard-note {
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.7;
            margin: -30px 0 40px;
        }

        /* FOOTER */
        footer {
            border-top: 1px solid var(--line);
            padding: 25px 0;
            color: var(--muted);
            font-size: 11px;
            text-align: center;
        }



        @media (max-width: 600px) {
            .page-header {
                padding-top: 45px;
            }

            .podium {
                gap: 8px;
            }

            .podium-card {
                padding: 20px 5px;
            }

            .podium-card.first {
                padding-top: 30px;
                padding-bottom: 30px;
            }

            .podium-card h3 {
                font-size: 11px;
            }

            .ranking-item {
                gap: 10px;
                padding: 14px 12px;
            }

            .rank-info strong {
                font-size: 12px;
            }

            .rank-points {
                font-size: 11px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <header class="wrap topbar">
        <a href="{{ url('/') }}" class="brand">
            <span class="brand-mark">☾</span>
            <span>SholatYuk</span>
        </a>

        <a href="{{ url('/') }}" class="back-link">
            ← Kembali ke beranda
        </a>
    </header>

    <main class="wrap">

        <!-- HEADER -->
        <section class="page-header">
            <div class="eyebrow">Komunitas dan motivasi</div>

            <h1>Berprestasi dalam<br>menjaga ibadah.</h1>

            <p class="subtitle">
                Lihat perkembangan teman-temanmu dan bangun
                semangat untuk menjaga konsistensi ibadah
                bersama komunitas SholatYuk.
            </p>
        </section>

        <!-- FILTER -->
        <nav class="period">
            <a href="#" class="active">Minggu ini</a>
            <a href="#">Bulan ini</a>
            <a href="#">Keseluruhan</a>
        </nav>

        <p class="leaderboard-note">
            Peringkat ditampilkan di antara teman dengan gender yang sama.
            Data yang ditampilkan merupakan simulasi.
        </p>

        <!-- PODIUM -->
        <section class="podium">

            <article class="podium-card">
                <div class="medal">🥈</div>
                <div class="avatar">NA</div>
                <h3>Nur Aisyah</h3>
                <div class="points">860 poin</div>
                <small>🔥 12 hari streak</small>
            </article>

            <article class="podium-card first">
                <div class="medal">🥇</div>
                <div class="avatar">MR</div>
                <h3>Muhammad Rizki</h3>
                <div class="points">980 poin</div>
                <small>🔥 18 hari streak</small>
            </article>

            <article class="podium-card">
                <div class="medal">🥉</div>
                <div class="avatar">FA</div>
                <h3>Fajar Ahmad</h3>
                <div class="points">790 poin</div>
                <small>🔥 9 hari streak</small>
            </article>

        </section>

        <!-- DAFTAR PERINGKAT -->
        <section class="ranking-section">

            <div class="section-title">
                <h2>Peringkat komunitas</h2>
                <span>Daftar pengguna</span>
            </div>

            <div class="ranking-list">

                @php
                    $users = [
                        ['rank' => 4, 'name' => 'Maura Artika', 'initial' => 'MA', 'points' => 740, 'streak' => 8],
                        ['rank' => 5, 'name' => 'Maritza Dara', 'initial' => 'MR', 'points' => 680, 'streak' => 7],
                        [
                            'rank' => 6,
                            'name' => 'Athilah Syahshiyah',
                            'initial' => 'AS',
                            'points' => 620,
                            'streak' => 6,
                        ],
                        ['rank' => 7, 'name' => 'Milawati', 'initial' => 'M', 'points' => 570, 'streak' => 5],
                        ['rank' => 8, 'name' => 'Kamu', 'initial' => 'K', 'points' => 520, 'streak' => 4],
                    ];
                @endphp

                @foreach ($users as $user)
                    <article class="ranking-item {{ $user['name'] === 'Kamu' ? 'me' : '' }}">

                        <div class="rank-number">
                            {{ $user['rank'] }}
                        </div>

                        <div class="rank-avatar">
                            {{ $user['initial'] }}
                        </div>

                        <div class="rank-info">
                            <strong>{{ $user['name'] }}</strong>
                            <small>🔥 {{ $user['streak'] }} hari streak</small>
                        </div>

                        <div class="rank-points">
                            {{ $user['points'] }} poin
                            <small>Minggu ini</small>
                        </div>

                    </article>
                @endforeach

            </div>
        </section>

    </main>

    <footer>
        <div class="wrap">
            ☾ SholatYuk — Temani setiap langkah menuju ibadah yang lebih baik.
        </div>
    </footer>

</body>

</html>
