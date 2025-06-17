<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KidzavingAccount;

class AccountController extends Controller
{

    public function verify(Request $request)
    {
        $cardNumber = $request->input('cardNumber');

        $account = KidzavingAccount::where('CardNumber', $cardNumber)->first();

        if ($account) {
            return response()->json(['success' => true, 'redirect' => url("/account/{$cardNumber}")]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid card number.']);
        }
    }

    public function show($cardNumber)
    {
        $account = KidzavingAccount::where('CardNumber', $cardNumber)->firstOrFail();

        return view('account.index', compact('account' , 'cardNumber'));
    }
    

}

