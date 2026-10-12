<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');

        $now = Carbon::now();

        switch ($period) {

            case 'day':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                break;

            case 'week':
                $startDate = $now->copy()->startOfWeek();
                $endDate = $now->copy()->endOfWeek();
                break;

            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;

            case 'month':
            default:
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $period = 'month';
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | USER YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        */

        $userId = auth()->id();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAPATAN USER
        |--------------------------------------------------------------------------
        */

        $totalIncome = Income::where('user_id', $userId)
            ->whereBetween('date', [
                $startDate->toDateString(),
                $endDate->toDateString()
            ])
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENGELUARAN USER
        |--------------------------------------------------------------------------
        */

        $totalExpense = Expense::where('user_id', $userId)
            ->whereBetween('date', [
                $startDate->toDateString(),
                $endDate->toDateString()
            ])
            ->sum('total');


        /*
        |--------------------------------------------------------------------------
        | SALDO
        |--------------------------------------------------------------------------
        */

        $balance = $totalIncome - $totalExpense;


        /*
        |--------------------------------------------------------------------------
        | PENDAPATAN TERBARU USER
        |--------------------------------------------------------------------------
        */

        $recentIncomes = Income::where('user_id', $userId)
            ->latest('date')
            ->latest('id')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENGELUARAN TERBARU USER
        |--------------------------------------------------------------------------
        */

        $recentExpenses = Expense::where('user_id', $userId)
            ->latest('date')
            ->latest('id')
            ->take(5)
            ->get();


      return view('dashboard.index', compact(
    'period',
    'startDate',
    'endDate',
    'totalIncome',
    'totalExpense',
    'balance',
    'recentIncomes',
    'recentExpenses'
));
    }
}
