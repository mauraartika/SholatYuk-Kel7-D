
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sholat Sunnah - SholatYuk</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

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

        .logo { color: #315c46; font-size: 22px; font-weight: 700; }

        nav a {
            color: #315c46;
            text-decoration: none;
            font-weight: 600;
        }

        .container { max-width: 950px; margin: 50px auto; padding: 0 24px; }

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

        .intro { color: #68736b; line-height: 1.7; margin-bottom: 28px; }

        .highlight {
            background: #315c46;
            color: white;
            padding: 24px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .highlight p { opacity: .85; font-size: 13px; }
        .highlight h2 { font-size: 22px; margin-top: 8px; }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .section-heading h2 { font-size: 20px; }

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

        .prayer h3 { font-size: 16px; margin-bottom: 5px; }
        .prayer p { color: #68736b; font-size: 12px; line-height: 1.5; }

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

        .prayer button.done { background: #315c46; color: white; }

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

        .add-form.show { display: block; }

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

        .save-button { background: #315c46; color: white; }
        .cancel-button { background: #e8eee7; color: #315c46; }

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

        .toast.show { opacity: 1; transform: translate(-50%, 0); }

        @media (max-width: 600px) {
            h1 { font-size: 30px; }
            .prayer-list { grid-template-columns: 1fr; }
            .section-heading { align-items: flex-start; }
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
                <div><h3>Sholat Rawatib</h3><p>Sebelum atau sesudah sholat wajib</p></div>
                <button onclick="togglePrayer(this, 'Rawatib')">Tandai</button>
            </div>

            <div class="prayer">
                <div><h3>Sholat Dhuha</h3><p>Pagi hingga menjelang Dzuhur</p></div>
                <button onclick="togglePrayer(this, 'Dhuha')">Tandai</button>
            </div>

            <div class="prayer">
                <div><h3>Sholat Tahajud</h3><p>Dikerjakan pada malam hari setelah tidur</p></div>
                <button onclick="togglePrayer(this, 'Tahajud')">Tandai</button>
            </div>

            <div class="prayer">
                <div><h3>Sholat Witir</h3><p>Setelah Isya hingga sebelum Subuh</p></div>
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
                <input type="text" id="prayerName"
                    placeholder="Contoh: Sholat Taubat" required maxlength="50">

                <label for="prayerNote">Keterangan (Opsional)</label>
                <input type="text" id="prayerNote"
                    placeholder="Contoh: Ketika ingin memohon ampun" maxlength="100">

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

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');

            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => toast.classList.remove('show'), 2500);
        }

        function getSavedPrayers() {
            return JSON.parse(localStorage.getItem('sholatYukSunnah') || '[]');
        }

        function savePrayers(prayers) {
            localStorage.setItem('sholatYukSunnah', JSON.stringify(prayers));
            localStorage.setItem('sholatYukSunnahCount', prayers.length);
        }

        function getCustomPrayers() {
            return JSON.parse(localStorage.getItem('sholatYukCustom') || '[]');
        }

        function saveCustomPrayers(prayers) {
            localStorage.setItem('sholatYukCustom', JSON.stringify(prayers));
        }

        function updateSummary() {
            const total = getSavedPrayers().length;
            document.getElementById('summary').textContent =
                total === 0
                    ? 'Belum ada ibadah yang dicatat'
                    : total + ' jenis sholat sunnah telah dicatat';
        }

        function togglePrayer(button, name) {
            let prayers = getSavedPrayers();

            if (prayers.includes(name)) {
                prayers = prayers.filter(prayer => prayer !== name);
                button.classList.remove('done');
                button.textContent = 'Tandai';
                showToast('Catatan Sholat ' + name + ' berhasil diperbarui!');
            } else {
                prayers.push(name);
                button.classList.add('done');
                button.textContent = 'Selesai ✓';
                showToast('Sholat ' + name + ' berhasil dicatat!');
            }

            savePrayers(prayers);
            updateSummary();
        }

        function showAddForm() {
            document.getElementById('addForm').classList.add('show');
            document.getElementById('prayerName').focus();
        }

        function hideAddForm() {
            document.getElementById('addForm').classList.remove('show');
            document.querySelector('#addForm form').reset();
        }

        function addPrayer(event) {
            event.preventDefault();

            const name = document.getElementById('prayerName').value.trim();
            const note = document.getElementById('prayerNote').value.trim();

            if (!name) {
                showToast('Nama sholat sunnah harus diisi!');
                return;
            }

            const custom = getCustomPrayers();

            const duplicate = custom.some(prayer =>
                prayer.name.toLowerCase() === name.toLowerCase()
            );

            const standardNames = ['Rawatib', 'Dhuha', 'Tahajud', 'Witir'];

            if (duplicate || standardNames.some(item => item.toLowerCase() === name.toLowerCase())) {
                showToast('Sholat tersebut sudah ada di daftar!');
                return;
            }

            custom.push({
                id: Date.now(),
                name: name,
                note: note
            });

            saveCustomPrayers(custom);
            renderCustomPrayers();
            hideAddForm();
            showToast('Sholat ' + name + ' berhasil ditambahkan!');
        }

        function renderCustomPrayers() {
            const list = document.getElementById('customList');
            const custom = getCustomPrayers();
            const completed = getSavedPrayers();

            list.innerHTML = '';

            custom.forEach(prayer => {
                const card = document.createElement('div');
                card.className = 'prayer custom-prayer';

                const top = document.createElement('div');
                top.className = 'prayer-top';

                const info = document.createElement('div');
                const title = document.createElement('h3');
                title.textContent = prayer.name;

                const description = document.createElement('p');
                description.textContent = prayer.note || 'Sholat sunnah tambahan';

                info.append(title, description);
                top.append(info);

                const bottom = document.createElement('div');
                bottom.className = 'prayer-bottom';

                const button = document.createElement('button');
                button.textContent = completed.includes('custom-' + prayer.id) ? 'Selesai ✓' : 'Tandai';

                if (completed.includes('custom-' + prayer.id)) {
                    button.classList.add('done');
                }

                button.onclick = () => togglePrayer(button, 'custom-' + prayer.id);

                const deleteButton = document.createElement('button');
                deleteButton.className = 'delete-button';
                deleteButton.textContent = 'Hapus';
                deleteButton.onclick = () => deletePrayer(prayer.id);

                bottom.append(button, deleteButton);
                card.append(top, bottom);
                list.append(card);
            });
        }

        function deletePrayer(id) {
            const prayer = getCustomPrayers().find(item => item.id === id);

            const updated = getCustomPrayers().filter(item => item.id !== id);
            saveCustomPrayers(updated);

            let completed = getSavedPrayers();
            completed = completed.filter(item => item !== 'custom-' + id);
            savePrayers(completed);

            renderCustomPrayers();
            updateSummary();
            showToast('Catatan ' + prayer.name + ' berhasil dihapus!');
        }

        function loadSavedPrayers() {
            const prayers = getSavedPrayers();

            document.querySelectorAll('#dailyList .prayer').forEach(item => {
                const name = item.querySelector('h3').textContent.replace('Sholat ', '');
                const button = item.querySelector('button');

                if (prayers.includes(name)) {
                    button.classList.add('done');
                    button.textContent = 'Selesai ✓';
                }
            });

            renderCustomPrayers();
            updateSummary();
        }

        loadSavedPrayers();
    </script>
</body>
</html>
