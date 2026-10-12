<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = auth()->user()
            ->incomes()
            ->latest('date')
            ->latest('id')
            ->paginate(10);

        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'note' => ['nullable', 'string'],
        ]);

        $validated['user_id'] = auth()->id();

        Income::create($validated);

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Pendapatan berhasil ditambahkan.');
    }

    public function edit(Income $income)
    {
        // Pastikan income milik user yang sedang login
        $income = auth()->user()
            ->incomes()
            ->findOrFail($income->id);

        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        // Pastikan income milik user yang sedang login
        $income = auth()->user()
            ->incomes()
            ->findOrFail($income->id);

        $validated = $request->validate([
            'date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'note' => ['nullable', 'string'],
        ]);

        $income->update($validated);

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Pendapatan berhasil diperbarui.');
    }

    public function destroy(Income $income)
    {
        // Pastikan income milik user yang sedang login
        $income = auth()->user()
            ->incomes()
            ->findOrFail($income->id);

        $income->delete();

        return redirect()
            ->route('incomes.index')
            ->with('success', 'Pendapatan berhasil dihapus.');
    }
}
