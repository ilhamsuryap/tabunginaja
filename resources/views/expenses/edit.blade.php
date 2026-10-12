@extends('layouts.app')

@section('title', 'Edit Pengeluaran')

@section('header', 'Edit Pengeluaran')

@section('content')

    <div class="max-w-2xl">

        <div class="bg-white border rounded-2xl p-6 shadow-sm">

            <form action="{{ route('expenses.update', $expense) }}" method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Tanggal
                    </label>

                    <input type="date" name="date" value="{{ old('date', $expense->date->format('Y-m-d')) }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nama Barang
                    </label>

                    <input type="text" name="item_name" value="{{ old('item_name', $expense->item_name) }}"
                        class="w-full border rounded-xl px-4 py-3" required>

                </div>

                <div class="grid md:grid-cols-2 gap-4">

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Harga
                        </label>

                        <input type="number" name="price" id="price" value="{{ old('price', $expense->price) }}"
                            min="0" class="w-full border rounded-xl px-4 py-3" required>

                    </div>

                    <div>

                        <label class="block text-sm font-medium mb-2">
                            Jumlah
                        </label>

                        <input type="number" name="quantity" id="quantity"
                            value="{{ old('quantity', $expense->quantity) }}" min="1"
                            class="w-full border rounded-xl px-4 py-3" required>

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Total
                    </label>

                    <input type="text" id="total_display" readonly
                        class="w-full border rounded-xl px-4 py-3
                           bg-gray-100 font-bold">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Catatan
                    </label>

                    <textarea name="note" rows="4" class="w-full border rounded-xl px-4 py-3">{{ old('note', $expense->note) }}</textarea>

                </div>

                <button class="px-5 py-3 bg-yellow-400
                       rounded-xl font-semibold">
                    Update Pengeluaran
                </button>

            </form>

        </div>

    </div>

    <script>
        const price = document.getElementById('price');
        const quantity = document.getElementById('quantity');
        const totalDisplay = document.getElementById('total_display');

        function calculateTotal() {

            const p = Number(price.value) || 0;
            const q = Number(quantity.value) || 0;

            const total = p * q;

            totalDisplay.value =
                'Rp ' + total.toLocaleString('id-ID');
        }

        price.addEventListener('input', calculateTotal);
        quantity.addEventListener('input', calculateTotal);

        calculateTotal();
    </script>

@endsection
