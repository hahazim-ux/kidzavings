document.addEventListener("DOMContentLoaded", function () {
  const qrScanner = new Html5Qrcode("reader");

  qrScanner.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: 200 },
    qrCodeMessage => {
      handleCard(cardCodeSanitize(qrCodeMessage));
    },
    errorMessage => {
      console.log("QR Scan Error:", errorMessage);
    }
  ).catch(err => console.error("Camera start error:", err));

  window.submitCard = function () {
    const cardNumber = document.getElementById('cardNumber').value.trim();
    if (!cardNumber) {
      alert("Please enter a card number.");
      return;
    }
    handleCard(cardCodeSanitize(cardNumber));
  }

  function cardCodeSanitize(code) {
    return code.replace(/[^a-zA-Z0-9]/g, '').toUpperCase(); // Optional: remove special characters
  }

  function handleCard(cardNumber) {
    document.getElementById('loading').style.display = 'block';

    fetch(verifyCardUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken
      },
      body: JSON.stringify({ cardNumber: cardNumber })
    })
    .then(res => res.json())
    .then(data => {
      document.getElementById('loading').style.display = 'none';
      if (data.success) {
        window.location.href = data.redirect;
      } else {
        alert(data.message || "Invalid card number.");
      }
    })
    .catch(err => {
      console.error("Verification error:", err);
      document.getElementById('loading').style.display = 'none';
      alert("Something went wrong. Please try again.");
    });
  }
});
