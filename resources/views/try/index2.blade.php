@extends('layout.web')

@section('content')

<link rel="stylesheet" href="style/camera.css">

<div class="main-bg"><div class="inner-bg"></div></div>
  <div class="scanner-container">
    <a href="{{ route('kidzavings.index') }}">
    <div class="logo-circle"></div>
    <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo"></a>
    <div id="reader"></div>
    <p class="instruction">Scan a code on your card</p>
  </div>

  <script src="https://unpkg.com/html5-qrcode"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const qrScanner = new Html5Qrcode("reader");
      qrScanner.start(
        { facingMode: "environment" },
        {
          fps: 10,
          qrbox: 200
        },
        qrCodeMessage => {
          alert(`QR Code Scanned: ${qrCodeMessage}`);
          qrScanner.stop(); // Stop scanning after first success
        },
        errorMessage => {
          console.log("QR Scan Error:", errorMessage);
        }
      ).catch(err => console.error("Camera start error:", err));
    });
  </script>

