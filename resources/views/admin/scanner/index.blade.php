<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scan QR</title>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">

<h1 class="text-2xl font-bold mb-4">Scan QR Tamu</h1>
<div id="reader" class="w-full max-w-md mx-auto"></div>
<div id="result" class="mt-4 text-center text-lg font-semibold"></div>

<!-- POPUP -->
<div id="popup-success" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-xl text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-2">TERIMA KASIH</h2>
        <p class="text-lg">Telah Hadir 🤝</p>
    </div>
</div>

<script>
function onScanSuccess(decodedText, decodedResult) {

    console.log("QR Terdeteksi:", decodedText);

    // AMBIL KODE SAJA (karena QR berisi URL)
    let code = decodedText.split('/').pop();

    fetch("{{ route('scanCode') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ code: code })
    })
    .then(res => res.json())
    .then(data => {

        console.log("Response server:", data);

        if (data.status === "success") {

            // Tampilkan popup sukses
            document.getElementById("popup-success").classList.remove("hidden");

            // STOP kamera biar tidak double scan
            html5QrcodeScanner.clear();

            // Redirect
            setTimeout(() => {
                window.location.href = "{{ route('admin.invitation.index') }}";
            }, 2000);

        } else {
            // Jika QR tidak valid atau sudah hadir
            document.getElementById("result").innerText = data.message;
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        document.getElementById("result").innerText = "Gagal terhubung ke server.";
    });

    // Popup cepat tambahan
    alert("Scan berhasil!");
}

// INISIALISASI SCANNER
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
);
html5QrcodeScanner.render(onScanSuccess);
</script>


</body>
</html>
