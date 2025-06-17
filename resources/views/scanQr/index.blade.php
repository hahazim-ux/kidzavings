@extends('layout.web')
@section('content')

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/camera.css') }}">
  <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body>
  <div class="container">
    <div class="main-bg"><div class="inner-bg"></div></div>
    
    <a href="{{ route('kidzavings.index') }}" class="btn-back">
    <i class="bi bi-chevron-left"></i>
    </a>

    <a href="{{ route('kidzavings.index') }}">
      <div class="logo-circle"></div>
      <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">
    </a>

    <div id="reader"></div>
    <p class="instruction">Scan a code on your card</p>
    <h4 class="mid-instruction">OR</h4>
    <p class="insert">Insert your card number manually here</p>

    <div class="manual-entry">
      <input type="text" id="cardNumber" name="cardNumber" placeholder="Example: ABG123456" maxlength="16" />
      <button id="submitCard" onclick="submitCard()">Submit</button>
    </div>

    <div id="loading" style="display: none; text-align: center; margin-top: 20px;">
  <div class="spinner"></div>
  <p>Verifying card...</p>
</div>

  </div>

<script>
  const verifyCardUrl = "{{ url('/verify-card') }}";
  const csrfToken = "{{ csrf_token() }}";
</script>

<script src="{{ asset('script/camera.js') }}"></script>


</body>
</html>

@stop
