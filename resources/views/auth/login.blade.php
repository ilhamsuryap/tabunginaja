<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Tabungan</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-yellow-50 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-6">

        <div class="w-full max-w-md">

            <div class="text-center mb-8">

                <div
                    class="w-16 h-16 bg-yellow-400
                       rounded-2xl flex items-center
                       justify-center text-2xl
                       font-bold mx-auto mb-4">
                    T
                </div>

                <h1 class="text-2xl font-bold">
                    Selamat Datang
                </h1>

                <p class="text-gray-500 mt-2">
                    Login ke akun tabungan Anda
                </p>

            </div>

            <div class="bg-white rounded-2xl
                    shadow-sm border p-7">

                @if (session('success'))
                    <div class="bg-green-50 text-green-700
                            p-4 rounded-xl mb-5">

                        {{ session('success') }}

                    </div>
                @endif

                @if ($errors->any())

                    <div class="bg-red-50 text-red-600
                            p-4 rounded-xl mb-5">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">

                    @csrf

                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>

                    <div>

                        <div class="flex justify-between mb-2">

                            <label class="text-sm font-medium">
                                Password
                            </label>

                            <a href="{{ route('password.request') }}" class="text-sm text-yellow-600">
                                Lupa password?
                            </a>

                        </div>

                        <input type="password" name="password" placeholder="Password"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>

                    <button
                        class="w-full bg-yellow-400
                           hover:bg-yellow-500
                           py-3 rounded-xl
                           font-semibold">
                        Login
                    </button>

                </form>

                <div class="flex items-center gap-3 my-6">

                    <div class="h-px bg-gray-200 flex-1"></div>

                    <span class="text-sm text-gray-400">
                        atau
                    </span>

                    <div class="h-px bg-gray-200 flex-1"></div>

                </div>

                <a href="{{ route('google.login') }}"
                    class="w-full border rounded-xl
                       py-3 flex items-center
                       justify-center gap-3
                       hover:bg-gray-50">

                    <span class="font-bold">
                        G
                    </span>

                    <span>
                        Login dengan Google
                    </span>

                </a>

                <div class="text-center mt-6">

                    <p class="text-sm text-gray-500">

                        Belum punya akun?

                        <a href="{{ route('register') }}"
                            class="text-yellow-600
                               font-semibold">
                            Daftar sekarang
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
