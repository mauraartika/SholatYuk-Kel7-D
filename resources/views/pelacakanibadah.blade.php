<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Ibadah - SholatYuk</title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f7f7f2;
            color: #18251e;
            font-family: "DM Sans", Arial, sans-serif;
        }

        nav {
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            border-bottom: 1px solid #e4e7df;
        }

        .logo {
            color: #315c46;
            font-size: 22px;
            font-weight: 700;
        }

        nav a {
            color: #315c46;
            text-decoration: none;
            font-weight: 600;
        }

        .container {
            max-width: 1000px;
            margin: 48px auto;
            padding: 0 24px;
        }

        .eyebrow {
            color: #68816f;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        h1 {
            font-family: "Playfair Display", Georgia, serif;
            font-size: 38px;
            margin: 10px 0;
        }

        .intro {
            color: #68736b;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .date-label {
            color: #68736b;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e4e7df;
            border-radius: 15px;
            padding: 22px;
        }

        .summary-card p {
            color: #68736b;
            font-size: 13px;
        }

        .summary-card h2 {
            color: #315c46;
            font-size: 30px;
            margin: 8px 0;
        }

        .summary-card small {
            color: #68736b;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .section-heading h2 {
            font-size: 20px;
        }

        .prayer-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 13px;
        }

        .prayer-item {
            background: white;
            border: 1px solid #e4e7df;
            border-radius: 13px;
            padding: 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .prayer-item h3 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .prayer-item p {
            color: #68736b;
            font-size: 12px;
        }

        .action-button {
            border: 0;
            border-radius: 9px;
            padding: 10px 13px;
            background: #e8eee7;
            color: #315c46;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .action-button.active {
            background: #315c46;
            color: white;
        }

        .sunnah-card {
            margin-top: 30px;
            background: #e8eee7;
            border-radius: 16px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        .sunnah-card h2 {
            color: #214633;
            font-size: 19px;
            margin-bottom: 7px;
        }

        .sunnah-card p {
            color: #526b59;
            font-size: 13px;
            line-height: 1.6;
        }

        .sunnah-card a {
            background: #315c46;
            color: white;
            text-decoration: none;
            padding: 12px 17px;
            border-radius: 9px;
            font-weight: 700;
            font-size: 13px;
            white-space: nowrap;
        }

        .progress-track {
            width: 100%;
            height: 8px;
            background: #e8eee7;
            border-radius: 20px;
            overflow: hidden;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: #315c46;
            border-radius: 20px;
            transition: width .25s ease;
        }

        .toast {
            position: fixed;
            bottom: 25px;
            left: 50%;
            transform: translate(-50%, 20px);
            background: #214633;
            color: white;
            padding: 14px 20px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 8px 25px #0002;
            opacity: 0;
            pointer-events: none;
            transition: .25s ease;
            z-index: 10;
            text-align: center;
            width: max-content;
            max-width: calc(100% - 32px);
        }

        .toast.show {
            opacity: 1;
            transform: translate(-50%, 0);
        }

        @media (max-width: 650px) {
            h1 {
                font-size: 30px;
            }

            .summary-grid,
            .prayer-list {
                grid-template-columns: 1fr;
            }

            .sunnah-card {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">SholatYuk.</div>
        <a href="{{ url('/') }}">← Kembali ke Home</a>
    </nav>

    <main class="container">
        <span class="eyebrow">DASHBOARD IBADAH</span>
        <h1>Catatan Ibadah</h1>
        <p class="intro">
            Pantau perjalanan ibadah harianmu dan bangun kebiasaan
            baik dengan mencatat sholat yang telah dikerjakan.
        </p>

        <p class="date-label" id="today"></p>

        <section class="summary-grid">
            <div class="summary-card">
                <p>Progress Sholat Wajib</p>
                <h2 id="wajibCount">0 dari 5</h2>
                <small id="wajibMessage">Yuk, mulai catat ibadah wajibmu hari ini.</small>
                <div class="progress-track">
                    <div class="progress-fill" id="wajibProgress"></div>
                </div>
            </div>

            <div class="summary-card">
                <p>Progress Sholat Sunnah</p>
                <h2 id="sunnahCount">0 tercatat</h2>
                <small id="sunnahMessage">Catat sholat sunnah yang sudah kamu kerjakan.</small>
                <div class="progress-track">
                    <div class="progress-fill" id="sunnahProgress"></div>
                </div>
            </div>
        </section>

        <section>
            <div class="section-heading">
                <h2>Ibadah Wajib Hari Ini</h2>
            </div>

            <div class="prayer-list">
                <div class="prayer-item">
                    <div>
                        <h3>Subuh</h3>
                        <p>Sholat wajib 2 rakaat</p>
                    </div>
                    <button class="action-button" onclick="toggleWajib(this, 'Subuh')">Tandai</button>
                </div>

                <div class="prayer-item">
                    <div>
                        <h3>Dzuhur</h3>
                        <p>Sholat wajib 4 rakaat</p>
                    </div>
                    <button class="action-button" onclick="toggleWajib(this, 'Dzuhur')">Tandai</button>
                </div>

                <div class="prayer-item">
                    <div>
                        <h3>Ashar</h3>
                        <p>Sholat wajib 4 rakaat</p>
                    </div>
                    <button class="action-button" onclick="toggleWajib(this, 'Ashar')">Tandai</button>
                </div>

                <div class="prayer-item">
                    <div>
                        <h3>Maghrib</h3>
                        <p>Sholat wajib 3 rakaat</p>
                    </div>
                    <button class="action-button" onclick="toggleWajib(this, 'Maghrib')">Tandai</button>
                </div>

                <div class="prayer-item">
                    <div>
                        <h3>Isya</h3>
                        <p>Sholat wajib 4 rakaat</p>
                    </div>
                    <button class="action-button" onclick="toggleWajib(this, 'Isya')">Tandai</button>
                </div>
            </div>
        </section>

        <section class="sunnah-card">
            <div>
                <h2>Progress Sholat Sunnah</h2>
                <p>Lihat dan catat berbagai sholat sunnah yang telah kamu kerjakan.</p>
            </div>
            <a href="{{ url('/sholat-sunnah') }}">Lihat Catatan →</a>
        </section>
    </main>

    <div class="toast" id="toast"></div>

    <script>
        let toastTimer;

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');

            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
        }

        function toggleWajib(button, nama) {
            const sudahDitandai = button.classList.contains('active');

            if (sudahDitandai) {
                const yakin = confirm(
                    `Apakah kamu yakin ingin membatalkan penandaan sholat ${nama}?`
                );

                if (!yakin) return;

                button.classList.remove('active');
                button.innerHTML = `Tandai ${nama}`;
                showToast(`Penandaan sholat ${nama} berhasil dibatalkan.`);
            } else {
                button.classList.add('active');
                button.innerHTML = `✓ ${nama} tercatat`;
                showToast(`Sholat ${nama} berhasil dicatat!`);
            }

            updateWajibProgress();
        }

        function updateWajibProgress() {
            const total = document.querySelectorAll('.prayer-item button.active').length;

            document.getElementById('wajibCount').textContent = total + ' dari 5';
            document.getElementById('wajibProgress').style.width = (total / 5 * 100) + '%';

            document.getElementById('wajibMessage').textContent =
                total === 5 ? 'Alhamdulillah, semua sholat wajib sudah tercatat!' :
                'Terus jaga konsistensi ibadah wajibmu.';
        }

        function updateSunnahProgress() {
            const saved = Number(localStorage.getItem('sholatYukSunnahCount') || 0);
            document.getElementById('sunnahCount').textContent = saved + ' tercatat';
            document.getElementById('sunnahProgress').style.width =
                (Math.min(saved, 4) / 4 * 100) + '%';
        }

        document.getElementById('today').textContent =
            new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });

        updateSunnahProgress();
    </script>
</body>

</html>
