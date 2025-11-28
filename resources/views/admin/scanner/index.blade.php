<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scan QR</title>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">

<h1 class="text-2xl font-bold mb-4">Scan QR Tamu</h1>
<div id="reader" class="w-full max-w-md mx-auto"></div>
<div id="result" class="mt-4 text-center text-lg font-semibold"></div>

<script>
function onScanSuccess(decodedText, decodedResult) {
    // Kirim kode ke server
    fetch("{{ route('scanCode') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ code: decodedText })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById("result").innerText = data.message;
    });
}

// inisialisasi scanner
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 }
);
html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
