<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Tabungan</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-yellow-50 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-6">

        <div class="w-full max-w-md">

            <div class="text-center mb-8">

                <div
                    class="w-16 h-16 bg-yellow-400 rounded-2xl
                       flex items-center justify-center
                       text-2xl font-bold mx-auto mb-4">
                    T
                </div>

                <h1 class="text-2xl font-bold">
                    Buat Akun
                </h1>

                <p class="text-gray-500 mt-2">
                    Mulai kelola tabungan Anda
                </p>

            </div>

            <div class="bg-white rounded-2xl shadow-sm
                    border p-7">

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

                <form action="{{ route('register.process') }}" method="POST" class="space-y-5">

                    @csrf

                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Username
                        </label>

                        <input type="text" name="username" value="{{ old('username') }}" placeholder="username"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>

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

                        <label class="block text-sm
                                  font-medium mb-2">
                            Password
                        </label>

                        <input type="password" name="password" placeholder="Minimal 8 karakter"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>

                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Konfirmasi Password
                        </label>

                        <input type="password" name="password_confirmation" placeholder="Ulangi password"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>

                    <button type="submit"
                        class="w-full bg-yellow-400
                           hover:bg-yellow-500
                           py-3 rounded-xl
                           font-semibold">
                        Daftar
                    </button>

                </form>

                <div class="text-center mt-6">

                    <p class="text-sm text-gray-500">

                        Sudah punya akun?

                        <a href="{{ route('login') }}"
                            class="text-yellow-600
                               font-semibold">
                            Login
                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
