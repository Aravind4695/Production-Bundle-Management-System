<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductionBundle;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalBundles = ProductionBundle::count();

        $totalQuantity = ProductionBundle::sum('quantity');

        $totalCompleted = ProductionBundle::sum('completed_qty');

        $totalRejected = ProductionBundle::sum('rejected_qty');

        $averageEfficiency = ProductionBundle::selectRaw(
            'AVG((completed_qty / quantity) * 100) as efficiency'
        )->value('efficiency');

        $todayProduction = ProductionBundle::whereDate(
            'production_date',
            today()
        )->sum('completed_qty');

        $todayRejection = ProductionBundle::whereDate(
            'production_date',
            today()
        )->sum('rejected_qty');

        return view('dashboard.dashboard', compact(
            'totalBundles',
            'totalQuantity',
            'totalCompleted',
            'totalRejected',
            'averageEfficiency',
            'todayProduction',
            'todayRejection'
        ));
    }
}
