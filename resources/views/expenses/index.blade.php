@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('header', 'Pengeluaran')

@section('content')

    <div class="space-y-6">

        <div class="flex justify-between items-center">

            <div>
                <p class="text-gray-500">
                    Daftar barang dan pengeluaran
                </p>
            </div>

            <a href="{{ route('expenses.create') }}"
                class="bg-yellow-400 px-5 py-3
                   rounded-xl font-semibold">
                + Tambah Pengeluaran
            </a>

        </div>

        <div class="bg-white border rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr>

                            <th class="text-left p-4">
                                Tanggal
                            </th>

                            <th class="text-left p-4">
                                Barang
                            </th>

                            <th class="text-right p-4">
                                Harga
                            </th>

                            <th class="text-center p-4">
                                Jumlah
                            </th>

                            <th class="text-right p-4">
                                Total
                            </th>

                            <th class="text-center p-4">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @forelse($expenses as $expense)
                            <tr>

                                <td class="p-4">
                                    {{ $expense->date->format('d/m/Y') }}
                                </td>

                                <td class="p-4 font-medium">
                                    {{ $expense->item_name }}
                                </td>

                                <td class="p-4 text-right">
                                    Rp {{ number_format($expense->price, 0, ',', '.') }}
                                </td>

                                <td class="p-4 text-center">
                                    {{ $expense->quantity }}
                                </td>

                                <td
                                    class="p-4 text-right
                                       font-semibold text-red-500">
                                    Rp {{ number_format($expense->total, 0, ',', '.') }}
                                </td>

                                <td class="p-4">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('expenses.edit', $expense) }}"
                                            class="px-3 py-2 bg-gray-100
                                               rounded-lg text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                            onsubmit="return confirm('Hapus data ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-2 bg-red-100
                                                   text-red-600 rounded-lg
                                                   text-sm">
                                                Hapus
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="p-10 text-center text-gray-500">
                                    Belum ada data pengeluaran.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{ $expenses->links() }}

    </div>

@endsection
