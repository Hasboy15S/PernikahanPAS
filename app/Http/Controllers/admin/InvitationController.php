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
            'messge' => $request->message,
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

$qrSvg = QrCode::format('svg')->size(300)->generate(url('/scan/' . $code));
    $qrFileName = 'qr_' . $code . '.svg';
    $qrPath = 'qr/' . $qrFileName;
    Storage::disk('public')->put($qrPath, $qrSvg);
    Mail::to($request->email)->send(new SendInvitationQR(
        $request->nama,
        $code,
        asset('storage/' . $qrPath)
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
public function scan($code)
{
    $inv = Invitation::where('code_qr', $code)->first();

    if (!$inv) {
        return view('invitation.scan_result', [
            'title' => 'QR Tidak Valid',
            'message' => 'Kode QR tidak ditemukan dalam sistem.'
        ]);
    }

    // Jika sudah hadir
    if ($inv->status === 'hadir') {
        return view('invitation.scan_result', [
            'title' => 'Sudah Tercatat',
            'message' => 'Anda sudah melakukan presensi sebelumnya.'
        ]);
    }

    // Update status menjadi hadir
    $inv->update([
        'status' => 'hadir'
    ]);

    return view('invitation.scan_result', [
        'title' => 'Presensi Berhasil!',
        'message' => 'Terima kasih, presensi Anda telah dicatat.'
    ]);
}
public function destroy($id)
{
    $inv = Invitation::findOrFail($id);

    // hapus file qr jika ada
    if ($inv->code_qr) {
        $file = 'qr/qr_' . $inv->code_qr . '.svg';
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
