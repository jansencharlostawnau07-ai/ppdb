<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => PpdbRegistration::count(),
            'diterima' => PpdbRegistration::where('status', 'diterima')->count(),
            'pending' => PpdbRegistration::where('status', 'pending')->count(),
        ];
        return view('ppdb.home', compact('stats'));
    }

    public function create()
    {
        return view('ppdb.daftar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nisn' => 'nullable|string|max:20',
            'nik' => 'nullable|string|max:25',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'required|date',
            'agama' => 'nullable|string|max:30',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
            'asal_sekolah' => 'required|string|max:100',
            'asal_smp_kategori' => 'required|in:ypsb,suster,umum',
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'no_hp_ortu' => 'nullable|string|max:20',
            'jalur' => 'required|in:reguler,prestasi,afirmasi',
            'gelombang' => 'required|in:1,2',
            'skema_bayar' => 'required|in:lunas,angsuran',
            'nominal_transfer' => 'nullable|numeric|min:0',
            'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ktp_ortu' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_baptis' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_rapor_8_ganjil' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_rapor_8_genap' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'file_bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $validated;
        $data['nama_bank'] = 'BNI-6617710032-YPSB-SMA-STO-PAULUS';
        foreach (['file_kk', 'file_akta', 'file_ktp_ortu', 'file_baptis', 'file_rapor_8_ganjil', 'file_rapor_8_genap', 'file_foto', 'file_bukti_transfer'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('ppdb', 'public');
            }
        }

        $data['no_pendaftaran'] = PpdbRegistration::generateNoPendaftaran();
        $data['status'] = 'pending';

        $pendaftaran = PpdbRegistration::create($data);

        return redirect()->route('ppdb.sukses', $pendaftaran->no_pendaftaran);
    }

    public function sukses(string $no)
    {
        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $no)->firstOrFail();
        return view('ppdb.sukses', compact('pendaftaran'));
    }

    public function cekForm()
    {
        return view('ppdb.cek');
    }

    public function biaya()
    {
        return view('ppdb.biaya');
    }

    public function beasiswa()
    {
        return view('ppdb.beasiswa');
    }

    public function panduan()
    {
        return view('ppdb.panduan');
    }

    public function cek(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $request->no_pendaftaran)
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (! $pendaftaran) {
            return back()->withErrors(['no_pendaftaran' => 'Data tidak ditemukan. Periksa nomor dan tanggal lahir.'])->withInput();
        }

        return view('ppdb.status', compact('pendaftaran'));
    }
}
