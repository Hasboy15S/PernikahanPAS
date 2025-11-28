<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scan QR Tamu</title>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    /* Animasi soft glow pada frame */
    .scanner-frame {
        border: 3px solid rgba(255, 255, 255, 0.4);
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(0,0,0,0.15);
        padding: 10px;
        backdrop-filter: blur(6px);
    }

    /* Animasi garis berjalan */
    .scanner-line {
        width: 100%;
        height: 3px;
        background: linear-gradient(to right, #00e676, #00c853);
        position: absolute;
        top: 0;
        left: 0;
        animation: scan 2s infinite ease-in-out;
        border-radius: 10px;
    }

    @keyframes scan {
        0%   { top: 0; opacity: 0.7; }
        50%  { top: 92%; opacity: 1; }
        100% { top: 0; opacity: 0.7; }
    }

    /* Popup animasi */
    .popup-show {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to   { opacity: 1; transform: scale(1); }
    }
</style>

</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 flex flex-col items-center justify-center min-h-screen p-5">

<!-- Title -->
<h1 class="text-3xl font-bold text-gray-800 mb-3 tracking-wide">
    Scan QR Tamu
</h1>

<p class="text-gray-600 mb-6">
    Silakan arahkan QR Code ke kamera
</p>

<!-- Scanner Wrapper -->
<div class="scanner-frame relative w-full max-w-sm mx-auto">
    <div class="scanner-line"></div>
    <div id="reader" class="rounded-xl overflow-hidden"></div>
</div>

<!-- Result -->
<div id="result" class="mt-5 text-lg font-semibold text-center text-gray-700"></div>

<!-- POPUP -->
<div id="popup-success" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl shadow-2xl text-center popup-show">
        <h2 class="text-3xl font-bold text-green-600 mb-2">SELAMAT DATANG</h2>
        <p class="text-gray-800 text-lg mb-3">Terima kasih telah hadir 🤝</p>

        <div class="mt-4">
            <button class="px-5 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition"
                onclick="window.location.reload()">
                Scan Lainnya
            </button>
        </div>
    </div>
</div>

<script>
function onScanSuccess(decodedText, decodedResult) {

    console.log("QR Terdeteksi:", decodedText);

    let code = decodedText.split('/').pop(); // ambil kode akhir

    fetch("{{ route('admin.scanCode') }}", {
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

            document.getElementById("popup-success").classList.remove("hidden");

            html5QrcodeScanner.clear();

            setTimeout(() => {
                window.location.href = "{{ route('admin.invitation.index') }}";
            }, 2000);

        } else {
            document.getElementById("result").innerHTML = 
                `<span class='text-red-600'>${data.message}</span>`;
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        document.getElementById("result").innerText = "Gagal terhubung ke server.";
    });

    // Sound effect optional
    // new Audio('/sounds/beep.mp3').play();
}

// INISIALISASI SCANNER
var html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 230 }
);
html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
