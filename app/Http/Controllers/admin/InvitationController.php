<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvitationQR;
use Endroid\QrCode\Writer\PngWriter; // tambahkan di atas
use Endroid\QrCode\Builder\Builder;



class InvitationController extends Controller
{
    public function index()
    {
        $data = Invitation::all();
        return view('admin.invitation.index', compact('data'));
    }

    public function edit($id)
    {
    $inv = Invitation::findOrFail($id);
    return view('admin.invitation.edit', compact('inv'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'jml_hadir' => 'required|integer|min:0',
        'message' => 'nullable|string',
        'status' => 'required|in:belum,hadir,batal', // status yang diperbolehkan
    ]);

    $inv = Invitation::findOrFail($id);

    $inv->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'jml_hadir' => $request->jml_hadir,
        'message' => $request->message,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.invitation.index')
        ->with('success', 'Data tamu berhasil diperbarui!');
}

    public function create()
    {
        return view('admin.invitation.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:invitations,email',
            'jml_hadir' => 'required|integer|min:1',
            'message' => 'nullable|string',
        ]);

        // Generate kode unik
        $code = strtoupper(Str::random(8));

        // Generate QR dalam bentuk SVG
        $qrSvg = QrCode::format('svg')
        ->size(300)
        ->generate(url('/scan/'.$code));

        // Simpan file QR sebagai SVG
        $qrFileName = 'qr_' . $code . '.svg';
        Storage::disk('public')->put('qr/' . $qrFileName, $qrSvg);

        // Simpan database
        $invitation = Invitation::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jml_hadir' => $request->jml_hadir,
            'message' => $request->message,
            'code_qr' => $code,
            'status' => 'belum'
        ]);

        // Kirim QR ke halaman agar bisa muncul popup
        return redirect()
            ->route('admin.invitation.index')
            ->with([
                'success' => 'Data berhasil ditambahkan!',
                'qr_popup' => asset('storage/qr/' . $qrFileName)
            ]);
    }
public function storeFront(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:invitations,email',
        'jml_hadir' => 'required|integer|min:1',
        'message' => 'nullable|string',
    ]);

    $code = strtoupper(Str::random(8));

$qrFileName = 'qr_' . $code . '.png';
$qrPath = 'qr/' . $qrFileName;

QrCode::format('png')->size(300)->generate($code, storage_path('app/public/' . $qrPath));

// Baca file PNG dan convert ke Base64
$qrData = base64_encode(file_get_contents(storage_path('app/public/' . $qrPath)));
$qrBase64 = 'data:image/png;base64,' . $qrData;

// Kirim email dengan embed Base64
Mail::to($request->email)->send(new SendInvitationQR(
    $request->nama,
    $code,
    $qrBase64
));
    Invitation::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'jml_hadir' => $request->jml_hadir,
        'message' => $request->message, // diperbaiki
        'code_qr' => $code,
        'status' => 'belum',
    ]);

    return redirect()
        ->route('index') // sudah ada name index
        ->with([
            'showQR' => true,
            'qrImage' => asset('storage/qr/' . $qrFileName),
            'qrCode' => $code
        ]);
}
public function scanner()
{
    return view('admin.scanner.scanner'); // halaman scanner
}

public function scanCode(Request $request)
{
    $code = $request->input('code'); // dapat dari scanner JS

    $inv = Invitation::where('code_qr', $code)->first();

    if (!$inv) {
        return response()->json(['status' => 'error', 'message' => 'QR Tidak Valid']);
    }

    if ($inv->status === 'hadir') {
        return response()->json(['status' => 'error', 'message' => 'Sudah tercatat']);
    }

    $inv->update(['status' => 'hadir']);

    return response()->json(['status' => 'success', 'message' => 'Presensi berhasil!']);
}

public function destroy($id)
{
    $inv = Invitation::findOrFail($id);

    // hapus file qr jika ada
    if ($inv->code_qr) {
        $file = 'qr/qr_' . $inv->code_qr . '.png';
        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }

    $inv->delete();

    return redirect()
        ->route('admin.invitation.index')
        ->with('success', 'Data berhasil dihapus');
}

}
