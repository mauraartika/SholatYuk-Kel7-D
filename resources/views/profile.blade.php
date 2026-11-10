<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SholatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap');

        .font-serif-custom {
            font-family: 'Playfair Display', serif;
        }

        .font-sans-custom {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f7f8f4] font-sans-custom min-h-screen text-gray-800 selection:bg-[#2a4d38] selection:text-white pb-12">

    <!-- Navbar Minimalis -->
    <header class="w-full bg-white shadow-sm py-4 px-8 mb-8 flex justify-between items-center">
        <a href="{{ url('/home') }}" class="flex items-center gap-2 text-[#2a4d38] font-bold text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
            SholatYuk
        </a>
        <a href="{{ url('/home') }}" class="text-sm font-medium text-gray-500 hover:text-[#2a4d38] transition-colors">
            ← Kembali ke Beranda
        </a>
    </header>

    <main class="max-w-3xl mx-auto px-4">

        <div class="mb-8">
            <h1 class="text-3xl font-serif-custom text-[#1a3023]">Pengaturan Profil</h1>
            <p class="text-gray-500 mt-2">Kelola informasi pribadi dan preferensi ibadahmu.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl text-sm font-medium border border-green-200">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Kolom Kiri: Informasi Pribadi -->
            <div class="md:col-span-1">
                <div
                    class="bg-white p-6 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 flex flex-col items-center text-center">
                    <div
                        class="w-24 h-24 bg-[#2a4d38] text-white rounded-full flex items-center justify-center text-4xl font-bold mb-4 shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h2 class="text-xl font-bold text-[#1a3023]">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ Auth::user()->email }}</p>

                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#f7f8f4] text-[#2a4d38] border border-gray-200 capitalize">
                        Gender: {{ Auth::user()->gender ?? 'Belum diatur' }}
                    </span>

                    <!-- Tombol Logout (Baru Ditambahkan) -->
                    <div class="w-full pt-6 border-t border-gray-100">
                        <form action="{{ url('/logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 text-red-600 font-medium text-sm py-2.5 px-4 rounded-xl hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pengaturan Notifikasi & Preferensi -->
            <div class="md:col-span-2">
                <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100">
                    <h3 class="text-lg font-bold text-[#1a3023] mb-6">Preferensi Notifikasi & Mode</h3>

                    <!-- Form untuk update toggle -->
                    <form action="{{ url('/profile/update-preferences') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            <!-- Toggle Mode DnD -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div>
                                    <div class="font-medium text-gray-800">Do Not Disturb</div>
                                    <div class="text-sm text-gray-500">Nonaktifkan semua notifikasi.</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="dnd" id="toggle-dnd" value="1"
                                        class="sr-only peer" {{ Auth::user()->dnd ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#2a4d38]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2a4d38]">
                                    </div>
                                </label>
                            </div>

                            <!-- Toggle Mode Libur -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div>
                                    <div class="font-medium text-gray-800">Mode Libur (Haid/Sakit)</div>
                                    <div class="text-sm text-gray-500">Nonaktifkan pengingat sholat wajib sementara
                                        waktu.</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="mode_libur" id="toggle-libur" value="1"
                                        class="sr-only peer" {{ Auth::user()->mode_libur ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#2a4d38]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2a4d38]">
                                    </div>
                                </label>
                            </div>

                            <!-- Toggle Notif Adzan -->
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                                <div>
                                    <div class="font-medium text-gray-800">Notifikasi Adzan</div>
                                    <div class="text-sm text-gray-500">Putar suara adzan saat waktu sholat tiba.</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_adzan_aktif" id="toggle-adzan" value="1"
                                        class="sr-only peer" {{ Auth::user()->notif_adzan_aktif ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#2a4d38]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2a4d38]">
                                    </div>
                                </label>
                            </div>

                            <!-- Toggle Notif Dalil -->
                            <div class="flex items-center justify-between pb-2">
                                <div>
                                    <div class="font-medium text-gray-800">Notifikasi Dalil Harian</div>
                                    <div class="text-sm text-gray-500">Terima kutipan ayat atau hadits inspiratif setiap
                                        pagi.</div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="notif_dalil_aktif" id="toggle-dalil" value="1"
                                        class="sr-only peer" {{ Auth::user()->notif_dalil_aktif ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#2a4d38]/50 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2a4d38]">
                                    </div>
                                </label>
                            </div>

                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit"
                                class="bg-[#2a4d38] text-white px-6 py-2.5 rounded-full font-medium hover:bg-[#1f3a2a] transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-[#2a4d38]">
                                Simpan Preferensi
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dndToggle = document.getElementById('toggle-dnd');
            const adzanToggle = document.getElementById('toggle-adzan');
            const dalilToggle = document.getElementById('toggle-dalil');

            if (dndToggle && adzanToggle && dalilToggle) {
                // Jika DnD dinyalakan, matikan notifikasi lain
                dndToggle.addEventListener('change', function() {
                    if (this.checked) {
                        adzanToggle.checked = false;
                        dalilToggle.checked = false;
                    }
                });

                // (Opsional) UX Tambahan: Jika user menyalakan notif secara manual, matikan DnD
                const turnOffDnd = function() {
                    if (this.checked) {
                        dndToggle.checked = false;
                    }
                };

                adzanToggle.addEventListener('change', turnOffDnd);
                dalilToggle.addEventListener('change', turnOffDnd);
            }
        });
    </script>

</body>

</html>
