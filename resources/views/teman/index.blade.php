<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teman - SholatYuk</title>

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
            padding: 0 0 110px;
            background: var(--paper);
            color: var(--ink);
            font-family: var(--sans);
            -webkit-font-smoothing: antialiased;
        }

        .container {
            width: min(760px, calc(100% - 48px));
            margin: auto;
            padding: 52px 0 35px;
        }

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0 0 9px;
            color: var(--ink);
            font: 600 38px/1.15 var(--serif);
            letter-spacing: -1px;
        }

        .header p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .card {
            background: var(--white);
            padding: 23px 25px;
            border: 1px solid var(--line);
            border-radius: 17px;
            margin-bottom: 17px;
            box-shadow: 0 5px 18px rgba(24, 37, 30, .035);
        }

        .card h2 {
            margin: 0 0 17px;
            color: var(--green-dark);
            font-size: 15px;
            font-weight: 700;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            min-width: 0;
            padding: 12px 15px;
            border: 1px solid var(--line);
            border-radius: 10px;
            background: #fcfcfa;
            color: var(--ink);
            font: 400 13px var(--sans);
            outline: none;
            transition: .2s ease;
        }

        .search-form input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(49, 92, 70, .09);
        }

        button,
        .btn {
            border: none;
            border-radius: 999px;
            padding: 11px 17px;
            font: 600 12px var(--sans);
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-primary {
            background: var(--green);
            color: white;
        }

        .btn-primary:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--mint);
            color: var(--green);
        }

        .btn-success:hover {
            background: #d9e7da;
        }

        .btn-danger {
            background: #fcebea;
            color: #a33b3b;
        }

        .btn-danger:hover {
            background: #f8dddd;
        }

        .btn-secondary {
            background: #edf1ed;
            color: #52675a;
        }

        .user-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #edf0e9;
        }

        .user-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .avatar {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--mint);
            color: var(--green);
            font-size: 15px;
            font-weight: 700;
        }

        .user-name {
            color: var(--ink);
            font-weight: 700;
            font-size: 13px;
        }

        .user-email {
            color: var(--muted);
            font-size: 11px;
            margin-top: 4px;
            overflow-wrap: anywhere;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .empty {
            padding: 17px 0 9px;
            color: var(--muted);
            font-size: 13px;
            text-align: center;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .alert-success {
            background: #e5f1e7;
            color: #28613b;
        }

        .alert-error {
            background: #fcebea;
            color: #a33b3b;
        }

        .section-label {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            padding: 5px 9px;
            border-radius: 20px;
            background: #fff4dd;
            color: #98702d;
            margin-top: 6px;
        }

        @media (max-width: 600px) {
            .container {
                width: calc(100% - 30px);
                padding-top: 30px;
            }

            .header h1 {
                font-size: 32px;
            }

            .card {
                padding: 19px 17px;
            }

            .user-item {
                align-items: flex-start;
            }

            .actions {
                flex-direction: column;
            }

            .actions button {
                width: 100%;
            }

            .search-form {
                gap: 7px;
            }

            .search-form input {
                padding: 11px;
            }
        }

        @media (max-width: 380px) {
            .user-item {
                flex-wrap: wrap;
            }

            .actions {
                width: 100%;
                flex-direction: row;
                padding-left: 56px;
            }
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 1.7px;
            font-size: 10px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .eyebrow::before {
            content: "";
            width: 25px;
            height: 1px;
            background: #78917e;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <div class="eyebrow">KOMUNITAS SHOLATYUK</div>
            <h1>Teman Ibadah</h1>
            <p>Terhubung dan saling mengingatkan untuk menjaga kebiasaan ibadah sehari-hari.</p>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Pencarian Teman --}}
        <div class="card">
            <h2>Cari Teman</h2>

            <form action="{{ route('teman.search') }}" method="GET" class="search-form">

                <input type="text" name="q" placeholder="Masukkan nama teman..."
                    value="{{ $keyword ?? request('q') }}" required minlength="2">

                <button type="submit" class="btn-primary">
                    Cari
                </button>
            </form>

            @isset($hasilPencarian)
                <div style="margin-top: 18px;">
                    <h2>Hasil Pencarian</h2>

                    @forelse($hasilPencarian as $user)
                        <div class="user-item">
                            <div class="user-info">
                                <div class="avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div>
                                    <div class="user-name">
                                        {{ $user->name }}
                                    </div>
                                    <div class="user-email">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('teman.store') }}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                <button type="submit" class="btn-success">
                                    + Tambah
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="empty">
                            Tidak ditemukan pengguna yang sesuai.
                        </div>
                    @endforelse
                </div>
            @endisset
        </div>

        {{-- Permintaan Masuk --}}
        <div class="card">
            <h2>Permintaan Masuk</h2>

            @forelse($permintaanMasuk as $item)
                <div class="user-item">
                    <div class="user-info">
                        <div class="avatar">
                            {{ strtoupper(substr($item->pengirim->name, 0, 1)) }}
                        </div>

                        <div>
                            <div class="user-name">
                                {{ $item->pengirim->name }}
                            </div>
                            <div class="user-email">
                                {{ $item->pengirim->email }}
                            </div>
                            <span class="section-label">Menunggu konfirmasi</span>
                        </div>
                    </div>

                    <div class="actions">
                        <form action="{{ route('teman.accept', $item->id) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn-success">
                                Terima
                            </button>
                        </form>

                        <form action="{{ route('teman.reject', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-danger">
                                Tolak
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty">
                    Belum ada permintaan pertemanan masuk.
                </div>
            @endforelse
        </div>

        {{-- Permintaan Keluar --}}
        <div class="card">
            <h2>Permintaan Terkirim</h2>

            @forelse($permintaanKeluar as $item)
                @php
                    $penerima = $item->pengguna1_id == auth()->id() ? $item->pengguna2 : $item->pengguna1;
                @endphp

                <div class="user-item">
                    <div class="user-info">
                        <div class="avatar">
                            {{ strtoupper(substr($penerima->name, 0, 1)) }}
                        </div>

                        <div>
                            <div class="user-name">
                                {{ $penerima->name }}
                            </div>
                            <div class="user-email">
                                {{ $penerima->email }}
                            </div>
                            <span class="section-label">Menunggu jawaban</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty">
                    Belum ada permintaan yang kamu kirim.
                </div>
            @endforelse
        </div>

        {{-- Daftar Teman --}}
        <div class="card">
            <h2>Daftar Teman ({{ $teman->count() }})</h2>

            @forelse($teman as $item)
                @php
                    $temanSaya = $item->pengguna1_id == auth()->id() ? $item->pengguna2 : $item->pengguna1;

                    $jumlahBelumDibaca = (int) ($jumlahPesanBelumDibaca[$temanSaya->id] ?? 0);
                @endphp

                <div class="user-item">
                    <div class="user-info">
                        <div class="avatar">
                            {{ strtoupper(substr($temanSaya->name, 0, 1)) }}
                        </div>

                        <div>
                            <div class="user-name">
                                {{ $temanSaya->name }}
                            </div>

                            @if ($jumlahBelumDibaca > 0)
                                <span
                                    style="
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    min-width: 20px;
                                    height: 20px;
                                    padding: 0 6px;
                                    margin-top: 5px;
                                    border-radius: 999px;
                                    background: #dc3545;
                                    color: white;
                                    font-size: 11px;
                                    font-weight: 700;
                                ">
                                    {{ $jumlahBelumDibaca > 99 ? '99+' : $jumlahBelumDibaca }}
                                </span>
                            @endif

                            <div class="user-email">
                                {{ $temanSaya->email }}
                            </div>
                            <span class="section-label" style="background:#e5f3e8;color:#28613b;">
                                Sudah berteman
                            </span>
                        </div>
                    </div>
                    <div class="actions">
                        <a href="{{ route('teman.streak', $temanSaya->id) }}" class="btn btn-primary"
                            style="text-decoration:none;">
                            Ruang Pengingat
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty">
                    Kamu belum memiliki teman. Yuk, mulai terhubung!
                </div>
            @endforelse
        </div>

    </div>

    @include('bottomnav')

</body>

</html>
