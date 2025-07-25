<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function getTransactions(Request $request)
    {
        $transactions = Transaction::with('category')
            ->when($request['category_id'], function ($query) use ($request) {
                $query->where('category_id', $request['category_id']);
            })
            ->paginate();
        return response()->json([
            'status' => true,
            'data' => $transactions,
            'message' => 'Successfully Obtained Transaction Data'
        ]);
    }

    public function getSummaryCategory(Request $request)
    {
        $month = $request['month'] ?? Carbon::now()->month;
        $year =  $request['year'] ?? Carbon::now()->year;
        $transactionsByCategory = Transaction::join('categories', 'categories.id', 'transactions.category_id')
            ->selectRaw('categories.name as categoryName, sum(amount) as total')
            ->whereRaw("EXTRACT(MONTH from transactions.transaction_date) = {$month}")
            ->whereRaw("EXTRACT(YEAR from transactions.transaction_date) = {$year}")
            ->groupBy('category_id', 'categories.name')->get();
        return response()->json([
            'status' => true,
            'data' => $transactionsByCategory,
            'message' => 'Successfully Obtained Summary Category'
        ]);
    }
    public function getSummaryOutcomePerMonth(Request $request)
    {
        $year =  $request['year'] ?? Carbon::now()->year;
        $transaction = Transaction::selectRaw('sum(amount) as total')
            ->whereRaw("EXTRACT(YEAR from transactions.transaction_date) = {$year}")
            ->groupByRaw('EXTRACT(MONTH from transactions.transaction_date)')
            ->get();
        return response()->json([
            'status' => true,
            'data' => $transaction,
            'message' => 'Successfully Obtained Summary Category'
        ]);
    }

    public function importTransaction(Request $request)
    {
        dd($request);
        try {
            DB::beginTransaction();
            $file = $request->file('file');
            Excel::import(new TransactionImport, $file);
            DB::commit();
            return response()->json([
                'status' => true,
                'data' => '',
                'message' => 'Successfully Import Data'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'data' => '',
                'message' => 'Import Data Failed' . $e->getMessage()
            ], 400);
        }
    }
}
