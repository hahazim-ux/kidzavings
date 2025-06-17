@extends('layout.web')
@section('content')
    
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/homepage.css') }}">
</head>
<body>
  <div class="container">

    <div class="main-bg"><div class="inner-bg"></div></div>

    <div class="logo-circle"></div>
    <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">

    <h2 class="welcome-text">WELCOME TO</h2>
    <h1 class="kidzavings-text">IDZAVINGS</h1>
    <div class="underline"></div>
    <p class="subtext">Navigate Your Transactions Now</p>


    <div class="qr-box"></div>
    <img src="{{ asset ('images/qr.jpg') }}" class="qr-image" alt="QR">

    <div class="button">
      <a href="{{ route('scanQr.index') }}"><span class="button-text">Start Now</span></a>
    </div>

    <img src="{{ asset('images/kidz_logo_white.png') }}" class="left-logo" alt="Kidzania White Logo">
  </div>
</body>
</html>




@stop