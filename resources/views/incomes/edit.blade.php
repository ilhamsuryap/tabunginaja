@extends('layouts.app')

@section('title', 'Edit Pendapatan')

@section('header', 'Edit Pendapatan')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <form action="{{ route('incomes.update', $income) }}" method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal
                    </label>

                    <input type="date" name="date" value="{{ old('date', $income->date->format('Y-m-d')) }}"
                        class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Keterangan
                    </label>

                    <input type="text" name="description" value="{{ old('description', $income->description) }}"
                        class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nominal
                    </label>

                    <input type="number" name="amount" value="{{ old('amount', $income->amount) }}" min="0"
                        class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Catatan
                    </label>

                    <textarea name="note" rows="4" class="w-full border rounded-xl px-4 py-3">{{ old('note', $income->note) }}</textarea>
                </div>

                <button class="px-5 py-3 bg-yellow-400
                       rounded-xl font-semibold">
                    Update Pendapatan
                </button>

            </form>

        </div>

    </div>

@endsection
