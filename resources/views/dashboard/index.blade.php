@extends('layouts.app')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')

    <div class="space-y-6">

        {{-- Filter --}}
        <div class="bg-white rounded-2xl p-5 shadow-sm border">

            <div class="flex flex-wrap gap-2">

                <a href="{{ route('dashboard', ['period' => 'day']) }}"
                    class="px-4 py-2 rounded-xl text-sm
                {{ $period === 'day' ? 'bg-yellow-400 font-semibold' : 'bg-gray-100' }}">
                    Hari
                </a>

                <a href="{{ route('dashboard', ['period' => 'week']) }}"
                    class="px-4 py-2 rounded-xl text-sm
                {{ $period === 'week' ? 'bg-yellow-400 font-semibold' : 'bg-gray-100' }}">
                    Minggu
                </a>

                <a href="{{ route('dashboard', ['period' => 'month']) }}"
                    class="px-4 py-2 rounded-xl text-sm
                {{ $period === 'month' ? 'bg-yellow-400 font-semibold' : 'bg-gray-100' }}">
                    Bulan
                </a>

                <a href="{{ route('dashboard', ['period' => 'year']) }}"
                    class="px-4 py-2 rounded-xl text-sm
                {{ $period === 'year' ? 'bg-yellow-400 font-semibold' : 'bg-gray-100' }}">
                    Tahun
                </a>

            </div>

        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Saldo --}}
            <div class="bg-yellow-400 rounded-2xl p-6">

                <p class="text-sm font-medium">
                    Saldo Bersih
                </p>

                <h3 class="text-3xl font-bold mt-2">
                    Rp {{ number_format($balance, 0, ',', '.') }}
                </h3>

                <p class="text-sm mt-2">
                    Pendapatan - Pengeluaran
                </p>

            </div>

            {{-- Income --}}
            <div class="bg-white border rounded-2xl p-6 shadow-sm">

                <p class="text-sm text-gray-500">
                    Total Pendapatan
                </p>

                <h3 class="text-2xl font-bold text-green-600 mt-2">
                    + Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </h3>

            </div>

            {{-- Expense --}}
            <div class="bg-white border rounded-2xl p-6 shadow-sm">

                <p class="text-sm text-gray-500">
                    Total Pengeluaran
                </p>

                <h3 class="text-2xl font-bold text-red-500 mt-2">
                    - Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </h3>

            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="grid md:grid-cols-2 gap-6">

            <a href="{{ route('incomes.create') }}"
                class="bg-white border rounded-2xl p-6
                   hover:border-yellow-400 transition">

                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12 bg-green-100
                            rounded-xl flex items-center
                            justify-center text-xl">
                        💰
                    </div>

                    <div>
                        <h3 class="font-bold">
                            Tambah Pendapatan
                        </h3>

                        <p class="text-sm text-gray-500">
                            Catat uang yang masuk
                        </p>
                    </div>

                </div>

            </a>

            <a href="{{ route('expenses.create') }}"
                class="bg-white border rounded-2xl p-6
                   hover:border-yellow-400 transition">

                <div class="flex items-center gap-4">

                    <div
                        class="w-12 h-12 bg-red-100
                            rounded-xl flex items-center
                            justify-center text-xl">
                        🛒
                    </div>

                    <div>
                        <h3 class="font-bold">
                            Tambah Pengeluaran
                        </h3>

                        <p class="text-sm text-gray-500">
                            Catat barang yang dibeli
                        </p>
                    </div>

                </div>

            </a>

        </div>

        {{-- Recent Transactions --}}
        <div class="bg-white border rounded-2xl shadow-sm">

            <div class="p-6 border-b">

                <h3 class="font-bold text-lg">
                    Transaksi Terbaru
                </h3>

            </div>

            <div class="divide-y">

                @foreach ($recentIncomes as $income)
                    <div class="p-5 flex justify-between items-center">

                        <div>

                            <p class="font-medium">
                                {{ $income->description }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $income->date->format('d M Y') }}
                            </p>

                        </div>

                        <span class="font-semibold text-green-600">
                            + Rp {{ number_format($income->amount, 0, ',', '.') }}
                        </span>

                    </div>
                @endforeach

                @foreach ($recentExpenses as $expense)
                    <div class="p-5 flex justify-between items-center">

                        <div>

                            <p class="font-medium">
                                {{ $expense->item_name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $expense->date->format('d M Y') }}
                            </p>

                        </div>

                        <span class="font-semibold text-red-500">
                            - Rp {{ number_format($expense->total, 0, ',', '.') }}
                        </span>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

@endsection
