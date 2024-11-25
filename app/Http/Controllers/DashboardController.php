<?php

namespace App\Http\Controllers;

use App\Services\StockTransaction\StockTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $stockService;

    public function __construct(StockTransactionService $stockService) {
        $this->stockService = $stockService;
    }

    public function redirectTo()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->role == "Staff Gudang") {
                return redirect('staff/dashboard');
            } elseif (Auth::user()->role == "Manajer Gudang") {
                return redirect('manajer/dashboard');
            }
        }

        return redirect(route('login'));
    }

    public function index()
    {
        $activities = session()->get('product_activities', []);

        if (Auth::user()->role == 'Admin') {
            return view('roles.admin.index', [
                'title' => 'Dashboard Admin',
                'activities' => $activities,
            ]);
        } elseif (Auth::user()->role == "Staff Gudang") {
            return view('roles.staff.index', [
                'title' => 'Dashboard Staff Gudang',
            ]);
        } elseif (Auth::user()->role == "Manajer Gudang") {
            return view('', [
                'title' => 'Dashboard Manajer Gudang'
            ]);
        }
    }
}
