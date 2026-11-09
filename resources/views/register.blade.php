<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SholatYuk</title>
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

<body
    class="bg-[#f7f8f4] font-sans-custom flex items-center justify-center min-h-screen py-12 selection:bg-[#2a4d38] selection:text-white">

    <div class="w-full max-w-md p-8">
        <!-- Logo Area -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center gap-2 text-[#2a4d38]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
                <span class="text-xl font-bold tracking-tight">SholatYuk</span>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100">
            <h2 class="text-3xl font-serif-custom text-[#1a3023] mb-2">Mulai Perjalananmu</h2>
            <p class="text-gray-500 text-sm mb-8">Daftar untuk menjaga ibadah hari ini bersama kami.</p>

            <form action="/register" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-medium">
                        <div class="flex items-center gap-2 mb-2 font-semibold">
                            <!-- Simple exclamation warning icon -->
                            <svg xmlns="http://w3.org" class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Pendaftaran Gagal:</span>
                        </div>
                        <ul class="list-disc pl-5 space-y-1 text-xs text-red-500">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required autofocus
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

              <!-- Input Jenis Kelamin (Radio Buttons) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                    <div class="flex items-center gap-6 px-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="laki-laki" required
                                class="w-4 h-4 text-[#2a4d38] bg-gray-50 border-gray-300 focus:ring-[#2a4d38]">
                            <span class="text-sm text-gray-700">Laki-laki</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="gender" value="perempuan" required
                                class="w-4 h-4 text-[#2a4d38] bg-gray-50 border-gray-300 focus:ring-[#2a4d38]">
                            <span class="text-sm text-gray-700">Perempuan</span>
                        </label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

                <div class="mb-8">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

                <button type="submit"
                    class="w-full bg-[#2a4d38] text-white font-medium py-3 px-4 rounded-full hover:bg-[#1f3a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2a4d38] transition-colors">
                    Sign Up
                </button>
            </form>
        </div>


        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ url('/') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
        </p>
    </div>
</body>

</html>
