<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = auth()->user()
            ->expenses()
            ->latest('date')
            ->latest('id')
            ->paginate(10);

        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'item_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string'],
        ]);

        $validated['total'] =
            $validated['price'] * $validated['quantity'];

        $validated['user_id'] = auth()->id();

        Expense::create($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function edit(Expense $expense)
    {
        // Pastikan expense milik user yang sedang login
        $expense = auth()->user()
            ->expenses()
            ->findOrFail($expense->id);

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        // Pastikan expense milik user yang sedang login
        $expense = auth()->user()
            ->expenses()
            ->findOrFail($expense->id);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'item_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string'],
        ]);

        $validated['total'] =
            $validated['price'] * $validated['quantity'];

        $expense->update($validated);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        // Pastikan expense milik user yang sedang login
        $expense = auth()->user()
            ->expenses()
            ->findOrFail($expense->id);

        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
