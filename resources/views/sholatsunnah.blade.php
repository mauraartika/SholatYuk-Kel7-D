<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sholat Sunnah - SholatYuk</title>

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
            max-width: 950px;
            margin: 50px auto;
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

        .highlight {
            background: #315c46;
            color: white;
            padding: 24px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .highlight p {
            opacity: .85;
            font-size: 13px;
        }

        .highlight h2 {
            font-size: 22px;
            margin-top: 8px;
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
            gap: 15px;
        }

        .prayer {
            background: white;
            border: 1px solid #e4e7df;
            border-radius: 14px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .prayer h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .prayer p {
            color: #68736b;
            font-size: 12px;
            line-height: 1.5;
        }

        .prayer button {
            border: 0;
            border-radius: 9px;
            padding: 10px 13px;
            background: #e8eee7;
            color: #315c46;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .prayer button.done {
            background: #315c46;
            color: white;
        }

        .add-button {
            background: #315c46;
            color: white;
            border: none;
            border-radius: 9px;
            padding: 11px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-form {
            background: white;
            border: 1px solid #e4e7df;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
            display: none;
        }

        .add-form.show {
            display: block;
        }

        .add-form label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin: 13px 0 7px;
        }

        .add-form input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dfe4dc;
            border-radius: 9px;
            font: inherit;
            outline-color: #315c46;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .form-actions button {
            padding: 11px 16px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-weight: 700;
        }

        .save-button {
            background: #315c46;
            color: white;
        }

        .cancel-button {
            background: #e8eee7;
            color: #315c46;
        }

        .delete-button {
            background: transparent !important;
            color: #a34d45 !important;
            padding: 5px !important;
            font-size: 12px;
        }

        .custom-prayer {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .custom-prayer .prayer-top {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .custom-prayer .prayer-bottom {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
            gap: 10px;
        }

        .note {
            margin-top: 25px;
            padding: 18px;
            background: #e8eee7;
            border-radius: 12px;
            color: #315c46;
            font-size: 13px;
            line-height: 1.7;
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

        @media (max-width: 600px) {
            h1 {
                font-size: 30px;
            }

            .prayer-list {
                grid-template-columns: 1fr;
            }

            .section-heading {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="logo">SholatYuk.</div>
        <a href="{{ url('/pelacakan-ibadah') }}">← Kembali ke Dashboard</a>
    </nav>

    <main class="container">
        <span class="eyebrow">CATATAN IBADAH</span>
        <h1>Sholat Sunnah</h1>
        <p class="intro">
            Catat berbagai sholat sunnah yang telah kamu kerjakan.
            Kamu juga bisa menambahkan jenis sholat sunnah lainnya.
        </p>

        <section class="highlight">
            <p>Catatan sholat sunnahmu</p>
            <h2 id="summary">Belum ada ibadah yang dicatat</h2>
        </section>

        <div class="section-heading">
            <h2>Sholat Sunnah Harian</h2>
        </div>

        <div class="prayer-list" id="dailyList">
            <div class="prayer">
                <div>
                    <h3>Sholat Rawatib</h3>
                    <p>Sebelum atau sesudah sholat wajib</p>
                </div>
                <button onclick="togglePrayer(this, 'Rawatib')">Tandai</button>
            </div>

            <div class="prayer">
                <div>
                    <h3>Sholat Dhuha</h3>
                    <p>Pagi hingga menjelang Dzuhur</p>
                </div>
                <button onclick="togglePrayer(this, 'Dhuha')">Tandai</button>
            </div>

            <div class="prayer">
                <div>
                    <h3>Sholat Tahajud</h3>
                    <p>Dikerjakan pada malam hari setelah tidur</p>
                </div>
                <button onclick="togglePrayer(this, 'Tahajud')">Tandai</button>
            </div>

            <div class="prayer">
                <div>
                    <h3>Sholat Witir</h3>
                    <p>Setelah Isya hingga sebelum Subuh</p>
                </div>
                <button onclick="togglePrayer(this, 'Witir')">Tandai</button>
            </div>
        </div>

        <div class="section-heading" style="margin-top: 32px;">
            <h2>Sholat Sunnah Lainnya</h2>
            <button class="add-button" onclick="showAddForm()">+ Tambah</button>
        </div>

        <div class="add-form" id="addForm">
            <h3>Tambah Sholat Sunnah</h3>

            <form onsubmit="addPrayer(event)">
                <label for="prayerName">Nama Sholat Sunnah</label>
                <input type="text" id="prayerName" placeholder="Contoh: Sholat Taubat" required maxlength="50">

                <label for="prayerNote">Keterangan (Opsional)</label>
                <input type="text" id="prayerNote" placeholder="Contoh: Ketika ingin memohon ampun" maxlength="100">

                <div class="form-actions">
                    <button type="submit" class="save-button">Simpan</button>
                    <button type="button" class="cancel-button" onclick="hideAddForm()">Batal</button>
                </div>
            </form>
        </div>

        <div class="prayer-list" id="customList"></div>

        <div class="note">
            ✨ Setiap ibadah memiliki nilai kebaikan.
            Catat perjalanan ibadahmu dan jaga konsistensinya.
        </div>
    </main>

    <div class="toast" id="toast"></div>

    <script>
        let toastTimer;
        let customPrayers = [];
        let customCompletedIds = new Set();

        const jenisIbadahSunnah = {
            'Rawatib': 6,
            'Dhuha': 7,
            'Tahajud': 8,
            'Witir': 9
        };

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');

            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        function getTanggalHariIni() {
            const tanggal = new Date();

            return [
                tanggal.getFullYear(),
                String(tanggal.getMonth() + 1).padStart(2, '0'),
                String(tanggal.getDate()).padStart(2, '0')
            ].join('-');
        }

        function getCustomPrayers() {
            return customPrayers;
        }

        function getSavedPrayers() {
            return JSON.parse(localStorage.getItem('sholatYukSunnah') || '[]');
        }

        function savePrayers(prayers) {
            localStorage.setItem('sholatYukSunnah', JSON.stringify(prayers));
            localStorage.setItem('sholatYukSunnahCount', prayers.length);
        }

        function updateSummary() {
            const totalWajibSunnah = getSavedPrayers().length;

            const totalCustomSunnah = customPrayers.filter(prayer =>
                customCompletedIds.has(Number(prayer.id))
            ).length;

            const total = totalWajibSunnah + totalCustomSunnah;

            document.getElementById('summary').textContent =
                total === 0 ?
                'Belum ada ibadah yang dicatat' :
                total + ' jenis sholat sunnah telah dicatat';
        }

        // Memuat catatan sholat sunnah dari PostgreSQL

        async function loadSavedPrayers() {
            try {
                const [ibadahResponse, jenisResponse] = await Promise.all([
                    fetch('/api/ibadah', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    }),
                    fetch('/api/jenis-ibadah', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                ]);

                const ibadahResult = await ibadahResponse.json();
                const jenisResult = await jenisResponse.json();

                if (!ibadahResponse.ok || !jenisResponse.ok) {
                    throw new Error('Gagal mengambil data ibadah.');
                }

                const tanggalHariIni = getTanggalHariIni();

                // Memuat empat sholat sunnah bawaan
                const completed = [];

                document.querySelectorAll('#dailyList .prayer').forEach(item => {
                    const name = item.querySelector('h3').textContent.replace('Sholat ', '');
                    const button = item.querySelector('button');
                    const id = jenisIbadahSunnah[name];

                    const record = ibadahResult.data.find(item =>
                        Number(item.jenis_ibadah_id) === id &&
                        String(item.tanggal).substring(0, 10) === tanggalHariIni
                    );

                    button.classList.remove('done');
                    button.textContent = 'Tandai';

                    if (record && record.status === 'selesai') {
                        button.classList.add('done');
                        button.textContent = 'Selesai ✓';
                        completed.push(name);
                    }
                });

                savePrayers(completed);

                // Memuat jenis sholat sunnah khusus dari PostgreSQL
                customPrayers = jenisResult.data.filter(item =>
                    item.user_id !== null
                );

                // Memuat status penyelesaian sholat khusus hari ini
                customCompletedIds = new Set(
                    ibadahResult.data
                    .filter(item =>
                        item.status === 'selesai' &&
                        String(item.tanggal).substring(0, 10) === tanggalHariIni
                    )
                    .map(item => Number(item.jenis_ibadah_id))
                );

                renderCustomPrayers();
                updateSummary();

            } catch (error) {
                console.error('Gagal memuat sholat sunnah:', error);
                showToast('Gagal memuat catatan sholat sunnah.');
            }
        }

        // Menandai atau membatalkan sholat sunnah bawaan

        async function togglePrayer(button, prayerIdentifier) {
            const isCustom = typeof prayerIdentifier === 'number';

            const id = isCustom ?
                prayerIdentifier :
                jenisIbadahSunnah[prayerIdentifier];

            if (!id) {
                showToast('Jenis sholat tidak ditemukan.');
                return;
            }

            const sudahDitandai = button.classList.contains('done');

            if (sudahDitandai) {
                const yakin = confirm('Apakah kamu yakin ingin membatalkan catatan ini?');
                if (!yakin) return;
            }

            button.disabled = true;

            const statusBaru = sudahDitandai ? 'belum' : 'selesai';

            try {
                const response = await fetch('/api/ibadah', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    },
                    body: JSON.stringify({
                        jenis_ibadah_id: id,
                        tanggal: getTanggalHariIni(),
                        status: statusBaru
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menyimpan catatan.');
                }

                if (statusBaru === 'selesai') {
                    button.classList.add('done');
                    button.textContent = 'Selesai ✓';

                    if (isCustom) {
                        customCompletedIds.add(id);
                    }

                    showToast('Sholat berhasil dicatat!');
                } else {
                    button.classList.remove('done');
                    button.textContent = 'Tandai';

                    if (isCustom) {
                        customCompletedIds.delete(id);
                    }

                    showToast('Catatan sholat berhasil dibatalkan.');
                }

                if (!isCustom) {
                    const completed = getSavedPrayers();

                    const updated = statusBaru === 'selesai' ? [...new Set([...completed, prayerIdentifier])] :
                        completed.filter(item => item !== prayerIdentifier);

                    savePrayers(updated);
                }

                updateSummary();

            } catch (error) {
                console.error('Gagal menyimpan sholat:', error);
                showToast(error.message || 'Terjadi kesalahan.');

            } finally {
                button.disabled = false;
            }
        }

        // Form tambah sholat sunnah khusus
        function showAddForm() {
            document.getElementById('addForm').classList.add('show');
            document.getElementById('prayerName').focus();
        }

        function hideAddForm() {
            document.getElementById('addForm').classList.remove('show');
            document.querySelector('#addForm form').reset();
        }

        async function addPrayer(event) {
            event.preventDefault();

            const name = document.getElementById('prayerName').value.trim();
            const note = document.getElementById('prayerNote').value.trim();

            if (!name) {
                showToast('Nama sholat sunnah harus diisi!');
                return;
            }

            const standardNames = Object.keys(jenisIbadahSunnah);

            const duplicate = customPrayers.some(prayer =>
                prayer.nama_ibadah.toLowerCase() === name.toLowerCase()
            );

            if (
                duplicate ||
                standardNames.some(item => item.toLowerCase() === name.toLowerCase())
            ) {
                showToast('Sholat tersebut sudah ada di daftar!');
                return;
            }

            const submitButton = document.querySelector(
                '#addForm button[type="submit"]'
            );

            submitButton.disabled = true;

            try {
                const response = await fetch('/api/jenis-ibadah', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    },
                    body: JSON.stringify({
                        nama_ibadah: name,
                        keterangan: note || null
                    })
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menambahkan sholat.');
                }

                customPrayers.push(result.data);

                renderCustomPrayers();
                updateSummary();
                hideAddForm();

                showToast('Sholat ' + name + ' berhasil ditambahkan!');

            } catch (error) {
                console.error('Gagal menambahkan sholat:', error);
                showToast(error.message || 'Terjadi kesalahan.');

            } finally {
                submitButton.disabled = false;
            }
        }

        function renderCustomPrayers() {
            const list = document.getElementById('customList');

            list.innerHTML = '';

            customPrayers.forEach(prayer => {
                const card = document.createElement('div');
                card.className = 'prayer custom-prayer';

                const top = document.createElement('div');
                top.className = 'prayer-top';

                const info = document.createElement('div');

                const title = document.createElement('h3');
                title.textContent = prayer.nama_ibadah;

                const description = document.createElement('p');
                description.textContent =
                    prayer.keterangan || 'Sholat sunnah tambahan';

                info.append(title, description);
                top.append(info);

                const bottom = document.createElement('div');
                bottom.className = 'prayer-bottom';

                const button = document.createElement('button');

                const isCompleted = customCompletedIds.has(Number(prayer.id));

                button.textContent = isCompleted ? 'Selesai ✓' : 'Tandai';

                if (isCompleted) {
                    button.classList.add('done');
                }

                button.onclick = () => togglePrayer(button, Number(prayer.id));

                const deleteButton = document.createElement('button');
                deleteButton.className = 'delete-button';
                deleteButton.textContent = 'Hapus';
                deleteButton.onclick = () => deletePrayer(Number(prayer.id));

                bottom.append(button, deleteButton);
                card.append(top, bottom);
                list.append(card);
            });
        }

        // Menghapus sholat sunnah khusus dari localStorage

        async function deletePrayer(id) {
            const prayer = customPrayers.find(item => Number(item.id) === id);

            if (!prayer) return;

            const yakin = confirm(
                'Apakah kamu yakin ingin menghapus ' + prayer.nama_ibadah + '?'
            );

            if (!yakin) return;

            try {
                const response = await fetch('/api/jenis-ibadah/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Gagal menghapus sholat.');
                }

                customPrayers = customPrayers.filter(
                    item => Number(item.id) !== id
                );

                customCompletedIds.delete(id);

                renderCustomPrayers();
                updateSummary();

                showToast('Sholat ' + prayer.nama_ibadah + ' berhasil dihapus!');

            } catch (error) {
                console.error('Gagal menghapus sholat:', error);
                showToast(error.message || 'Terjadi kesalahan.');
            }
        }

        // Inisialisasi halaman
        loadSavedPrayers();
    </script>
</body>

</html>
