<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KidzavingAccount;

class KidzavingsController extends Controller
{

    public function try ()
    {
        return view ('try.index');
    }

    public function index ()
    {
        return view ('kidzavings.index');
    }

    public function scanner ()
    {
        return view ('scanQr.index');
    }

    public function account ()
    {
        $accounts = KidzavingAccount::all();
        return view ( 'account.index', compact('accounts'));
    }

    public function transaction ()
    {
        return view ('transaction.index');
    }
}
