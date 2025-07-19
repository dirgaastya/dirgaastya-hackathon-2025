<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function getTransactions(Request $request)
    {
        $transactions = Transaction::with('category')
                        ->when($request['category_id'],function($query) use($request){
                            $query->where('category_id', $request['category_id']);
                        })
                        ->paginate();
           return response()->json([
            'status' => true,
            'data'=> $transactions,
            'message' => 'Successfully Obtained Category Data'
        ]);
    }
}
