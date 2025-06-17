{{-- @extends('layout.web')
@section('content')
    
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/transaction.css') }}">
</head>
<body>
  <div class="container">

    <div class="main-bg"><div class="inner-bg"></div></div>

    <div class="logo-circle"></div>
    <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">

    <h2 class="welcome-text">TRANSACTION</h2>

    </div>
</body>
</html>




@stop --}}

@extends('layout.web')
@section('content')

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/transaction.css') }}">
</head>
<body>

    <div class="main-bg"><div class ="inner-bg"></div></div>

    <a href="{{ route('account.index') }}" class="btn-back">
    <i class="bi bi-chevron-left"></i>
    </a>

    <a href="{{ route('kidzavings.index') }}">
      <div class="logo-circle"></div>
      <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">
    </a>
<div class="container">

  <div class="main-bg"><div class ="inner-bg"></div></div>

    <a href="{{ route('scanQr.index') }}" class="btn-back">
    <i class="bi bi-chevron-left"></i>
    </a>

    <a href="{{ route('kidzavings.index') }}">
      <div class="logo-circle"></div>
      <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">
    </a>

    <h2>Transaction History for Card: {{ $account->CardNumber }}</h2>

    @if($transaction->isEmpty())
        <p>No transactions found.</p>
    @else
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount (RM)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction as $txn)
                    <tr>
                        <td>{{ $txn->IdTransaction }}</td>
                        <td>{{ $txn->transactionType->Description }}</td>
                        <td>{{ number_format($txn->Amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($txn->TransactionDate)->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>

@stop
