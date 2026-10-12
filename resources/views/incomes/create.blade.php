@extends('layouts.app')

@section('title', 'Tambah Pendapatan')

@section('header', 'Tambah Pendapatan')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <form action="{{ route('incomes.store') }}" method="POST" class="space-y-5">

                @csrf

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal
                    </label>

                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}"
                        class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-yellow-400"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Keterangan
                    </label>

                    <input type="text" name="description" value="{{ old('description') }}"
                        placeholder="Contoh: Gaji, Bonus, Uang saku" class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nominal
                    </label>

                    <input type="number" name="amount" value="{{ old('amount') }}" placeholder="500000" min="0"
                        class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Catatan
                    </label>

                    <textarea name="note" rows="4" class="w-full border rounded-xl px-4 py-3">{{ old('note') }}</textarea>
                </div>

                <div class="flex gap-3">

                    <a href="{{ route('incomes.index') }}" class="px-5 py-3 bg-gray-100 rounded-xl">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-5 py-3 bg-yellow-400
                           rounded-xl font-semibold">
                        Simpan Pendapatan
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection
