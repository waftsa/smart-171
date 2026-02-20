<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donatur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Monthly donations chart data (current year, from Donatur with payment_status = success)
        $year = now()->year;

        $monthlyDonations = Donatur::where('payment_status', 'success')
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // Build full 12-month array (fill 0 for missing months)
        $chartLabels = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)));
        $chartData   = collect(range(1, 12))->map(fn($m) => (int) ($monthlyDonations[$m] ?? 0));

        // Top 5 donations by total collected amount
        $topDonations = Donation::withCount([
                'donaturs as total_collected' => fn($q) => $q->select(DB::raw('SUM(total_amount)'))
            ])
            ->orderByDesc('total_collected')
            ->take(5)
            ->get();

        // Summary stats
        $totalDonatur   = Donatur::where('payment_status', 'success')->count();
        $totalCollected = Donatur::where('payment_status', 'success')->sum('total_amount');
        $totalCampaign  = Donation::count();

        return view('dashboard', compact(
            'chartLabels',
            'chartData',
            'topDonations',
            'totalDonatur',
            'totalCollected',
            'totalCampaign'
        ));
    }
}
