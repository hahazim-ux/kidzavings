<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KidzavingAccount;
use App\Models\KidzavingTransaction;

class TransactionController extends Controller
{
    public function index($cardNumber)
    {
        $account = KidzavingAccount::where('CardNumber', $cardNumber)->first();

        if (!$account) {
            return redirect()->back()->with('error', 'Card not found.');
        }
 
        $transaction = KidzavingTransaction::where('IdKidzavingsAccount', $account->IdKidzavingsAccount)
            ->with('transactionType') // eager load the Description
            ->orderByDesc('TransactionDate')
            ->paginate(3);

        return view('transaction.index', compact('account', 'transaction'));
    }
}


