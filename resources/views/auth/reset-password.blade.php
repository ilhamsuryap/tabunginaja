<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Tabungan</title>

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
                        🔑
                    </div>

                    <h1 class="text-2xl font-bold">
                        Reset Password
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Buat password baru
                    </p>

                </div>


                {{-- KODE RESET --}}
                @if (session('reset_code'))
                    <div
                        class="bg-yellow-100
                           border-2 border-yellow-400
                           rounded-xl p-5 mb-6 text-center">

                        <p class="text-sm text-gray-600 mb-2">
                            Kode reset Anda:
                        </p>

                        <div
                            class="text-4xl font-bold
                               tracking-[0.5em]
                               text-gray-900">
                            {{ session('reset_code') }}
                        </div>

                        <p class="text-xs text-gray-500 mt-3">
                            Kode berlaku selama 10 menit.
                        </p>

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


                <form action="{{ route('password.reset') }}" method="POST" class="space-y-5">

                    @csrf

                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Masukkan Kode
                        </label>

                        <input type="text" name="code" maxlength="6" inputmode="numeric" placeholder="123456"
                            class="w-full border rounded-xl
                               px-4 py-3 text-center
                               text-xl tracking-widest"
                            required>

                    </div>


                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Password Baru
                        </label>

                        <input type="password" name="password" placeholder="Minimal 8 karakter"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>


                    <div>

                        <label class="block text-sm
                                  font-medium mb-2">
                            Konfirmasi Password Baru
                        </label>

                        <input type="password" name="password_confirmation" placeholder="Ulangi password"
                            class="w-full border rounded-xl
                               px-4 py-3" required>

                    </div>


                    <button
                        class="w-full bg-yellow-400
                           hover:bg-yellow-500
                           py-3 rounded-xl
                           font-semibold">
                        Reset Password
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
