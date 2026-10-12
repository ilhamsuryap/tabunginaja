<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Tabungan')
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FACC15',
                        dark: '#18181B',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white border-r hidden md:flex flex-col">

            <div class="p-6 border-b">
                <div class="flex items-center gap-3">

                    <div>
                        <h1 class="font-bold text-lg">
                            Tabungan
                        </h1>

                        <p class="text-xs text-gray-500">
                            Financial Dashboard
                        </p>
                    </div>

                </div>
            </div>

            <nav class="p-4 space-y-2">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                hover:bg-yellow-50
                {{ request()->routeIs('dashboard') ? 'bg-yellow-100 font-semibold' : '' }}">

                    Dashboard
                </a>

                <a href="{{ route('incomes.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                hover:bg-yellow-50
                {{ request()->routeIs('incomes.*') ? 'bg-yellow-100 font-semibold' : '' }}">

                    Pendapatan
                </a>

                <a href="{{ route('expenses.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                hover:bg-yellow-50
                {{ request()->routeIs('expenses.*') ? 'bg-yellow-100 font-semibold' : '' }}">

                    Pengeluaran
                </a>

            </nav>

        </aside>

        {{-- Main --}}
        <main class="flex-1">

            {{-- Mobile/Header --}}
            <header class="bg-white border-b px-6 py-4">

                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="font-bold text-xl">
                            @yield('header', 'Dashboard')
                        </h2>

                        <p class="text-sm text-gray-500">
                            Kelola keuangan Anda dengan mudah
                        </p>
                    </div>

                    {{-- User Info + Logout --}}
                    <div class="flex items-center gap-3">

                        <div class="text-right hidden sm:block">
                            <p class="font-semibold text-sm">
                                {{ auth()->user()->username ?? auth()->user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->email }}
                            </p>
                        </div>

                        <div
                            class="w-10 h-10 bg-yellow-100
                    rounded-full flex items-center
                    justify-center">
                            👤
                        </div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="px-4 py-2 rounded-xl
                        bg-red-50 text-red-600
                        hover:bg-red-100
                        font-semibold text-sm
                        transition">
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </header>

            <section class="p-6">

                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())

                    <div
                        class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-xl">

                        <ul class="list-disc ml-5">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                @yield('content')

            </section>

        </main>

    </div>

</body>

</html>
