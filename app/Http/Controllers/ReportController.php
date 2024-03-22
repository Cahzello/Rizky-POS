<?php

namespace App\Http\Controllers;

use App\Models\Sales_by_product;
use App\Models\Sales_summary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $data = Sales_summary::latest()->get();
        return view('reportView.reportIndex', [
            'data' => $data
        ]);
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

        if($salesSummary->total_sales == null || $salesSummary->total_transactions == 0){
            return redirect(route('reports.index'))->withErrors('No Sales has been created or transactions created within time, please try other time.');
        }

        $arraySalesSummary = [
            'users_id' => auth()->id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_transactions' => $salesSummary->total_transactions,
            'total_sales' => $salesSummary->total_sales,
        ];

        // dd($arraySalesSummary);

        $salesSummaryItem = Sales_summary::create($arraySalesSummary);

        foreach ($salesProductReport as $key => $value) {
            $arrayByProduct = [
                'users_id' => auth()->id(),
                'sales_summary_id' => $salesSummaryItem->id,
                'name' => $value->name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'total_sold' => $value->total_sold,
                'total_sales' => $value->total_sales,
            ];

            Sales_by_product::create($arrayByProduct);
        }

        return redirect(route('reports.index'))->with('success', 'Report Successfully Generated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salesSummary = Sales_summary::find($id);
        $salesByProduct = Sales_by_product::find($salesSummary->id)->all();
        // dd($salesByProduct);
        return view('reportView.reportShow', [
            'salesSummary' => $salesSummary,
            'salesByProduct' => $salesByProduct,
        ]);
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

}
