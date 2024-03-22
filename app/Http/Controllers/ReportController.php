<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reportView.reportIndex');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $salesSummary = $this->salesSummaryReport($request->start_date, $request->end_date);
        $salesProductReport = $this->salesByProductReport($request->start_date, $request->end_date);
        $inventoryStatus = $this->inventoryStatusReport($request->start_date, $request->end_date);

        dd($salesSummary, $salesProductReport, $inventoryStatus);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('reportView.reportShow');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function salesSummaryReport($startTimestamp, $endTimestamp)
    {
        $summary = DB::table('transactions')
            ->whereBetween('created_at', [$startTimestamp, $endTimestamp])
            ->select(
                DB::raw('COUNT(*) as total_transactions'),
                DB::raw('SUM(total_amount) as total_sales'),
                DB::raw('AVG(total_amount) as average_transaction_value')
            )
            ->first();

        return $summary;
    }

    public function salesByProductReport($startTimestamp, $endTimestamp)
    {
        $report = DB::table('transactions')
            ->join('transactions_items', 'transactions.id', '=', 'transactions_items.transaction_id')
            ->join('items', 'transactions_items.items_id', '=', 'items.id')
            ->whereBetween('transactions.created_at', [$startTimestamp, $endTimestamp])
            ->select(
                'items.name',
                DB::raw('SUM(transactions_items.quantity) as total_sold'),
                DB::raw('SUM(transactions_items.quantity * items.price) as total_sales')
            )
            ->groupBy('items.name')
            ->get();

        return $report;
    }

    public function inventoryStatusReport($startTimestamp, $endTimestamp)
    {
        $report = DB::table('items')
            ->whereBetween('created_at', [$startTimestamp, $endTimestamp])
            ->select(
                'name',
                'stock_level',
                DB::raw('CASE WHEN stock_level <= 5 THEN "Low Stock" ELSE "In Stock" END as stock_status')
            )
            ->get();

        return $report;
    }
}
