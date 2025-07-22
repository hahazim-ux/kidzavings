<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KidzavingAccount;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{

    public function index($cardNumber)
{
    $transaction = KidzavingAccount::where('CardNumber', $cardNumber)->first();

    if (!$transaction) {
        return redirect()->back()->with('error', 'Card not found.');
    }

    return view('transaction.index', [
        'cardNumber' => $cardNumber,
        'transaction' => $transaction
    ]);
}


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

     DB::statement("USE KIDZOFT_LOCAL;");
    // 🔐 Step 1: Open the symmetric key for decryption

    DB::statement("OPEN MASTER KEY DECRYPTION BY PASSWORD = 'Kz89204at75';");

    DB::statement("OPEN SYMMETRIC KEY SymmetricKey1 DECRYPTION BY CERTIFICATE Certificate1;");

    // 🔍 Step 2: Get decrypted visitor info using IdUniversal from account
    $visitor = DB::selectOne("
        SELECT 
            IdUniversal,
            CONVERT(nvarchar(255), DecryptByKey(Name)) AS Name,
            CONVERT(nvarchar(255), DecryptByKey(LastName)) AS LastName
        FROM dbo.ENC_VISITOR
        WHERE IdUniversal = ?
    ", [$account->IdUniversal]);

    // 🔒 Step 3: Close the symmetric key
    DB::statement("CLOSE SYMMETRIC KEY SymmetricKey1;");

    // ✅ Step 4: Pass all to the view
    return view('account.index', compact('account', 'visitor', 'cardNumber'));
}






    

}

