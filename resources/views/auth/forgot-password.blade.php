<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lupa Password - Tabungan</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-yellow-50 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-6">

        <div class="w-full max-w-md">

            <div class="bg-white border shadow-sm
                    rounded-2xl p-7">

                <div class="text-center mb-7">

                    <div
                        class="w-14 h-14 bg-yellow-400
                           rounded-xl flex items-center
                           justify-center mx-auto mb-4">
                        🔐
                    </div>

                    <h1 class="text-2xl font-bold">
                        Lupa Password?
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Masukkan email yang terdaftar
                    </p>

                </div>

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

                <form action="{{ route('password.send') }}" method="POST" class="space-y-5">

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

                    <button
                        class="w-full bg-yellow-400
                           hover:bg-yellow-500
                           py-3 rounded-xl
                           font-semibold">
                        Buat Kode Reset
                    </button>

                </form>

                <div class="text-center mt-6">

                    <a href="{{ route('login') }}" class="text-sm text-yellow-600">
                        ← Kembali ke Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
