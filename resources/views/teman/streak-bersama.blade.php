<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Pengingat - SholatYuk</title>

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
            --sans: "DM Sans", Arial, sans-serif;
            --serif: "Playfair Display", Georgia, serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0 0 100px;
            background: var(--paper);
            color: var(--ink);
            font-family: var(--sans);
        }

        .container {
            width: min(680px, calc(100% - 30px));
            margin: auto;
            padding: 30px 0;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: var(--green);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
        }

        .chat-card {
            overflow: hidden;
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 5px 18px rgba(24, 37, 30, .035);
        }

        .chat-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 17px 20px;
            border-bottom: 1px solid var(--line);
        }

        .avatar {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--mint);
            color: var(--green);
            font-weight: 700;
            font-size: 17px;
        }

        .header-info {
            flex: 1;
            min-width: 0;
        }

        .header-name {
            font-size: 14px;
            font-weight: 700;
        }

        .header-subtitle {
            margin-top: 3px;
            color: var(--muted);
            font-size: 11px;
        }

        .streak-badge {
            padding: 8px 11px;
            border-radius: 20px;
            background: var(--mint);
            color: var(--green);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .streak-panel {
            padding: 18px 20px;
            text-align: center;
            background: #fafbf8;
            border-bottom: 1px solid var(--line);
        }

        .streak-number {
            color: var(--green-dark);
            font: 600 34px/1.2 var(--serif);
        }

        .streak-caption {
            margin-top: 5px;
            color: var(--muted);
            font-size: 11px;
        }

        .progress {
            display: flex;
            gap: 6px;
            width: 150px;
            margin: 13px auto 0;
        }

        .progress-segment {
            flex: 1;
            height: 6px;
            border-radius: 10px;
            background: #e4e9e2;
        }

        .progress-segment.filled {
            background: var(--green);
        }

        .streak-status {
            margin-top: 12px;
            color: var(--green);
            font-size: 11px;
            font-weight: 600;
        }

        .activity-panel {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            padding: 13px 18px;
            border-bottom: 1px solid var(--line);
        }

        .activity-item {
            padding: 10px;
            border-radius: 10px;
            background: #fafbf8;
        }

        .activity-label {
            color: var(--muted);
            font-size: 10px;
            margin-bottom: 5px;
        }

        .activity-value {
            font-size: 11px;
            font-weight: 700;
        }

        .activity-value.done {
            color: var(--green);
        }

        .activity-value.pending {
            color: #98702d;
        }

        .chat-body {
            min-height: 260px;
            max-height: 480px;
            overflow-y: auto;
            padding: 20px 16px;
            background: #f8f9f5;
        }

        .date-label {
            width: fit-content;
            margin: 0 auto 18px;
            padding: 6px 11px;
            border-radius: 20px;
            background: #edf0e9;
            color: var(--muted);
            font-size: 10px;
        }

        .message-row {
            display: flex;
            margin-bottom: 13px;
        }

        .message-row.outgoing {
            justify-content: flex-end;
        }

        .message-row.incoming {
            justify-content: flex-start;
        }

        .message-bubble {
            max-width: 82%;
            padding: 11px 13px 8px;
            border-radius: 14px;
            box-shadow: 0 2px 5px rgba(24, 37, 30, .035);
        }

        .outgoing .message-bubble {
            background: #e4eee4;
            border-bottom-right-radius: 4px;
        }

        .incoming .message-bubble {
            background: var(--white);
            border: 1px solid var(--line);
            border-bottom-left-radius: 4px;
        }

        .message-sender {
            margin-bottom: 5px;
            color: var(--green);
            font-size: 10px;
            font-weight: 700;
        }

        .message-text {
            font-size: 12px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .message-time {
            margin-top: 5px;
            color: var(--muted);
            text-align: right;
            font-size: 9px;
        }

        .empty-chat {
            padding: 45px 15px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.7;
        }

        .empty-chat strong {
            display: block;
            margin-bottom: 7px;
            color: var(--green-dark);
            font-size: 14px;
        }

        .composer {
            padding: 18px;
            border-top: 1px solid var(--line);
            background: var(--white);
        }

        .composer-title {
            margin-bottom: 5px;
            color: var(--green-dark);
            font-size: 14px;
            font-weight: 700;
        }

        .composer-description {
            margin-bottom: 13px;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.6;
        }

        .template-option {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 12px;
            margin-bottom: 8px;
            border: 1px solid var(--line);
            border-radius: 11px;
            cursor: pointer;
            transition: .2s ease;
        }

        .template-option:hover {
            border-color: var(--green);
            background: #fafcf9;
        }

        .template-option input {
            margin-top: 2px;
            accent-color: var(--green);
        }

        .template-text {
            font-size: 11px;
            line-height: 1.6;
        }

        .send-button {
            width: 100%;
            margin-top: 8px;
            padding: 13px;
            border: none;
            border-radius: 999px;
            background: var(--green);
            color: white;
            font: 600 12px var(--sans);
            cursor: pointer;
        }

        .send-button:hover {
            background: var(--green-dark);
        }

        .notice {
            margin-top: 13px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #faf9f3;
            border: 1px solid var(--line);
            color: var(--muted);
            font-size: 10px;
            line-height: 1.7;
        }

        .alert {
            padding: 12px 15px;
            margin-bottom: 13px;
            border-radius: 10px;
            font-size: 12px;
        }

        .alert-success {
            background: #e5f1e7;
            color: #28613b;
        }

        .alert-error {
            background: #fcebea;
            color: #a33b3b;
        }

        @media (max-width: 480px) {
            .container {
                padding-top: 20px;
            }

            .chat-header {
                padding: 14px;
            }

            .chat-body {
                max-height: 430px;
            }

            .activity-panel {
                padding: 11px;
                gap: 7px;
            }

            .message-bubble {
                max-width: 88%;
            }
        }
    </style>
</head>

<body>

    <main class="container">

        <a href="{{ route('teman.index') }}" class="back-link">
            ← Kembali ke Daftar Teman
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <section class="chat-card">

            {{-- Header percakapan --}}
            <header class="chat-header">

                <div class="avatar">
                    {{ strtoupper(substr($teman->name, 0, 1)) }}
                </div>

                <div class="header-info">
                    <div class="header-name">{{ $teman->name }}</div>
                    <div class="header-subtitle">Teman ibadah SholatYuk</div>
                </div>

                <div class="streak-badge">
                    🔥 {{ $streak['jumlah_hari'] }} hari
                </div>

            </header>

            {{-- Informasi streak --}}
            <section class="streak-panel">

                @if ($streak['aktif'])
                    <div class="streak-number">
                        🔥 {{ $streak['jumlah_hari'] }} hari
                    </div>
                @else
                    <div class="streak-number">
                        🔥 {{ $streak['jumlah_hari'] }} / 3
                    </div>
                @endif

                <div class="progress">
                    @for ($i = 1; $i <= 3; $i++)
                        <div
                            class="progress-segment
                            {{ $streak['progres_aktivasi'] >= $i ? 'filled' : '' }}">
                        </div>
                    @endfor
                </div>

                <div class="streak-status">
                    @if ($streak['aktif'])
                        Streak bersama sudah aktif!
                    @else
                        Progres aktivasi: {{ $streak['progres_aktivasi'] }} dari 3 hari
                    @endif
                </div>

            </section>

            {{-- Status aktivitas hari ini --}}
            <section class="activity-panel">

                <div class="activity-item">
                    <div class="activity-label">Aktivitas kamu hari ini</div>
                    <div class="activity-value {{ $kamuSudahMengirim ? 'done' : 'pending' }}">
                        {{ $kamuSudahMengirim ? '✓ Sudah mengirim' : 'Belum mengirim' }}
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-label">Aktivitas teman hari ini</div>
                    <div class="activity-value {{ $temanSudahMengirim ? 'done' : 'pending' }}">
                        {{ $temanSudahMengirim ? '✓ Sudah mengirim' : 'Belum mengirim' }}
                    </div>
                </div>

            </section>

            {{-- Riwayat percakapan --}}
            <section class="chat-body" id="chatBody">

                <div class="date-label">Riwayat pengingat</div>

                @forelse ($pesan as $item)
                    @php
                        $pesanSaya = (int) $item->pengirim_id === (int) auth()->id();
                    @endphp

                    <div class="message-row {{ $pesanSaya ? 'outgoing' : 'incoming' }}">

                        <div class="message-bubble">

                            @if (!$pesanSaya)
                                <div class="message-sender">
                                    {{ $item->pengirim->name ?? $teman->name }}
                                </div>
                            @endif

                            <div class="message-text">
                                {{ $item->isi_pesan }}
                            </div>

                            <div class="message-time">
                                {{ $item->waktu_kirim->timezone(config('app.timezone'))->format('d M Y, H:i') }}
                                WIB
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="empty-chat">
                        <strong>Belum ada percakapan</strong>
                        Mulailah dengan mengirim pengingat kepada temanmu.
                        Pesan yang dikirim akan muncul di sini.
                    </div>
                @endforelse

            </section>

            {{-- Area pengiriman template --}}
            <section class="composer">

                <div class="composer-title">Kirim Pengingat</div>

                <div class="composer-description">
                    Pilih salah satu pesan yang tersedia untuk
                    {{ $teman->name }}. Kamu tidak dapat mengetik pesan sendiri.
                </div>

                <form action="{{ route('teman.streak.pengingat', $teman->id) }}" method="POST">
                    @csrf

                    @foreach ($templates as $key => $message)
                        <label class="template-option">

                            <input type="radio" name="template" value="{{ $key }}"
                                {{ old('template') === $key ? 'checked' : '' }} required>

                            <span class="template-text">
                                {{ $message }}
                            </span>

                        </label>
                    @endforeach

                    <button type="submit" class="send-button">
                        Kirim Pengingat
                    </button>

                </form>

            </section>

        </section>

        <div class="notice">
            <strong>Bagaimana streak bersama bekerja?</strong><br>
            Kedua anggota harus saling mengirim minimal satu pengingat
            setiap hari kalender. Streak aktif setelah tiga hari berturut-turut
            memenuhi ketentuan tersebut. Membuka ruang pengingat saja
            tidak menambah jumlah hari.
        </div>

    </main>

    @include('bottomnav')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBody = document.getElementById('chatBody');

            if (chatBody) {
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });
    </script>

</body>

</html>
