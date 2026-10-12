@extends('layouts.app')

@section('title', 'Pendapatan')

@section('header', 'Pendapatan')

@section('content')

    <div class="space-y-6">

        <div class="flex justify-between items-center">

            <div>
                <p class="text-gray-500">
                    Daftar uang yang masuk
                </p>
            </div>

            <a href="{{ route('incomes.create') }}"
                class="bg-yellow-400 px-5 py-3
                   rounded-xl font-semibold">
                + Tambah Pendapatan
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
                                Keterangan
                            </th>

                            <th class="text-right p-4">
                                Nominal
                            </th>

                            <th class="text-center p-4">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y">

                        @forelse($incomes as $income)
                            <tr>

                                <td class="p-4">
                                    {{ $income->date->format('d/m/Y') }}
                                </td>

                                <td class="p-4">
                                    {{ $income->description }}
                                </td>

                                <td
                                    class="p-4 text-right
                                       font-semibold text-green-600">
                                    Rp {{ number_format($income->amount, 0, ',', '.') }}
                                </td>

                                <td class="p-4">

                                    <div class="flex justify-center gap-2">

                                        <a href="{{ route('incomes.edit', $income) }}"
                                            class="px-3 py-2 bg-gray-100
                                               rounded-lg text-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('incomes.destroy', $income) }}" method="POST"
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

                                <td colspan="4" class="p-10 text-center text-gray-500">
                                    Belum ada data pendapatan.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{ $incomes->links() }}

    </div>

@endsection
