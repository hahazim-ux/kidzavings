@extends('layout.web')
@section('content')
    
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/account.css') }}">
</head>
<body>

<div class="container">

    <div class="main-bg"><div class ="inner-bg"></div></div>

    <a href="{{ route('scanQr.index') }}" class="btn-back">
    <i class="bi bi-chevron-left"></i>
    </a>

    <a href="{{ route('kidzavings.index') }}">
      <div class="logo-circle"></div>
      <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">
    </a>

<table>
  <thead>
    <tr>
      <th>Card Number</th>
      <th>Balance</th>
      <th>Date Register</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td data-label="Card Number">{{ $account->CardNumber }}</td>
      <td data-label="Balance">{{ number_format($account->Balance, 2) }} <img src="{{ asset('images/kidzos.png') }}" class="kidzos-icon" alt="Kidzos currency"></td>
      <td data-label="Date Register">{{ \Carbon\Carbon::parse($account->RegisterDate)->format('d M Y') }}</td>
    </tr>
  </tbody>
</table>

<div class="transaction">
<a href="{{ route('transaction.index', ['cardNumber' => $cardNumber]) }}">View Transaction</a>
</div>

</div>

</body>
</html>

@stop