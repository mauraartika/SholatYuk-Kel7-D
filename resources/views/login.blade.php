<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SholatYuk</title>
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
    class="bg-[#f7f8f4] font-sans-custom flex items-center justify-center min-h-screen selection:bg-[#2a4d38] selection:text-white">

    <div class="w-full max-w-md p-8">
        <!-- Logo Area -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center gap-2 text-[#2a4d38]">
                <!-- Placeholder for SholatYuk Crescent/Logo -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                </svg>
                <span class="text-xl font-bold tracking-tight">SholatYuk</span>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="bg-white p-8 rounded-3xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100">
            <h2 class="text-3xl font-serif-custom text-[#1a3023] mb-2">Selamat Datang</h2>
            <p class="text-gray-500 text-sm mb-8">Masuk untuk melanjutkan ibadah harianmu.</p>


            <form action="/" method="POST">
                @csrf

                <!-- 🌟 PASTE THE ERROR BLOCK RIGHT HERE 🌟 -->
                @if ($errors->any())
                    <div
                        style="color: red; background-color: #fde8e8; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-5">

                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2a4d38] focus:border-transparent transition-all">
                </div>

                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember"
                            class="h-4 w-4 text-[#2a4d38] focus:ring-[#2a4d38] border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-600">Ingat saya</label>
                    </div>


                    <button type="submit"
                        class="w-full bg-[#2a4d38] text-white font-medium py-3 px-4 rounded-full hover:bg-[#1f3a2a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2a4d38] transition-colors">
                        Masuk
                    </button>
                </div>
            </form>
        </div>


        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ url('/register') }}" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
        </p>
    </div>
</body>

</html>
