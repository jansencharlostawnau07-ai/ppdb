<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    public function daftarStep(Request $request, $step = 1)
    {
        $step = (int) $step;
        if ($step < 1 || $step > 4) {
            return redirect()->route('ppdb.daftar', ['step' => 1]);
        }

        $saved = session('ppdb_form', []);

        return view('ppdb.daftar', [
            'step' => $step,
            'saved' => $saved,
        ]);
    }

    public function daftarStoreStep(Request $request, $step)
    {
        $step = (int) $step;
        if ($step < 1 || $step > 4) {
            return redirect()->route('ppdb.daftar', ['step' => 1]);
        }

        $saved = session('ppdb_form', []);

        switch ($step) {
            case 1:
                $validated = $request->validate([
                    'nama_lengkap' => 'required|string|max:100',
                    'nisn' => 'nullable|digits:10',
                    'nik' => [
                        'nullable',
                        'digits:16',
                        function ($attribute, $value, $fail) use ($request) {
                            $tgl = $request->input('tanggal_lahir');
                            if (! $value || ! $tgl) {
                                return;
                            }
                            try {
                                $date = \Carbon\Carbon::parse($tgl);
                            } catch (\Exception $e) {
                                return;
                            }
                            $day = (int) substr($value, 6, 2);
                            if ($day > 40) {
                                $day -= 40;
                            }
                            $month = (int) substr($value, 8, 2);
                            $yy = substr($value, 10, 2);
                            if ((int) $date->format('d') !== $day
                                || (int) $date->format('m') !== $month
                                || (int) $date->format('y') !== (int) $yy) {
                                $fail('Tanggal lahir di NIK tidak cocok dengan Tanggal Lahir (digit 7–12 NIK = DDMMYY).');
                            }
                        },
                    ],
                    'jenis_kelamin' => 'required|in:L,P',
                    'tempat_lahir' => 'nullable|string|max:50',
                    'tanggal_lahir' => 'required|date|before:today',
                    'agama' => 'nullable|string|max:30',
                    'alamat' => 'required|string|max:2000',
                    'no_hp' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]{9,20}$/'],
                    'email' => 'nullable|email|max:100',
                    'asal_sekolah' => 'required|string|max:100',
                    'asal_smp_kategori' => 'required|in:ypsb,suster,umum',
                    'tahun_lulus' => 'nullable|string|max:4',
                    'rata_rata_rapor' => 'nullable|numeric|min:0|max:100',
                    'jalur' => 'required|in:reguler,prestasi,afirmasi',
                    'gelombang' => 'required|in:1,2',
                    'skema_bayar' => 'required|in:lunas,angsuran',
                ]);
                $saved['step1'] = $validated;
                break;

            case 2:
                $validated = $request->validate([
                    'nama_ayah' => 'nullable|string|max:100',
                    'pekerjaan_ayah' => 'nullable|string|max:50',
                    'nama_ibu' => 'nullable|string|max:100',
                    'pekerjaan_ibu' => 'nullable|string|max:50',
                    'no_hp_ortu' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]{9,20}$/'],
                ]);
                $saved['step2'] = $validated;
                break;

            case 3:
                $validated = $request->validate([
                    'file_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_akta' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_ktp_ortu' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_baptis' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_rapor_8_ganjil' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_rapor_8_genap' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'file_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048|dimensions:min_width=200,min_height=200',
                ]);
                foreach (['file_kk', 'file_akta', 'file_ktp_ortu', 'file_baptis', 'file_rapor_8_ganjil', 'file_rapor_8_genap', 'file_foto'] as $field) {
                    if ($request->hasFile($field)) {
                        $saved['step3'][$field] = $request->file($field)->store('ppdb_temp', 'public');
                    }
                }
                break;

            case 4:
                $validated = $request->validate([
                    'file_bukti_transfer' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                    'nominal_transfer' => 'nullable|numeric|min:0|max:999999999',
                ]);
                if ($request->hasFile('file_bukti_transfer')) {
                    $saved['step4']['file_bukti_transfer'] = $request->file('file_bukti_transfer')->store('ppdb_temp', 'public');
                }
                $saved['step4']['nominal_transfer'] = $validated['nominal_transfer'] ?? null;
                break;
        }

        session(['ppdb_form' => $saved]);

        if ($step < 4) {
            return redirect()->route('ppdb.daftar', ['step' => $step + 1])
                ->with('success', 'Langkah ' . $step . ' tersimpan. Lanjut ke langkah ' . ($step + 1) . '.');
        }

        return redirect()->route('ppdb.daftar.submit.form');
    }

    public function daftarSubmitForm()
    {
        $saved = session('ppdb_form', []);
        if (empty($saved)) {
            return redirect()->route('ppdb.daftar', ['step' => 1]);
        }

        return view('ppdb.daftar_submit', compact('saved'));
    }

    public function daftarSubmit(Request $request)
    {
        $saved = session('ppdb_form', []);
        if (empty($saved)) {
            return redirect()->route('ppdb.daftar', ['step' => 1]);
        }

        $step1 = $saved['step1'] ?? [];
        $step2 = $saved['step2'] ?? [];
        $step4 = $saved['step4'] ?? [];

        $data = array_merge($step1, $step2, [
            'nama_bank' => 'BNI-6617710032-YPSB-SMA-STO-PAULUS',
            'nominal_transfer' => $step4['nominal_transfer'] ?? null,
            'status' => 'pending',
        ]);

        foreach (['file_kk', 'file_akta', 'file_ktp_ortu', 'file_baptis', 'file_rapor_8_ganjil', 'file_rapor_8_genap', 'file_foto', 'file_bukti_transfer'] as $field) {
            if (! empty($saved['step3'][$field] ?? null)) {
                $data[$field] = $saved['step3'][$field];
            }
            if (! empty($saved['step4']['file_bukti_transfer'] ?? null) && $field === 'file_bukti_transfer') {
                $data[$field] = $saved['step4']['file_bukti_transfer'];
            }
        }

        // Pindah file dari ppdb_temp ke ppdb permanen
        foreach ($data as $key => $val) {
            if (is_string($val) && str_starts_with($val, 'ppdb_temp/')) {
                $data[$key] = Storage::disk('public')->move($val, str_replace('ppdb_temp/', 'ppdb/', $val));
            }
        }

        $data['no_pendaftaran'] = PpdbRegistration::generateNoPendaftaran();

        try {
            $pendaftaran = DB::transaction(function () use ($data) {
                $attempt = 0;
                while (true) {
                    $attempt++;
                    try {
                        return PpdbRegistration::create($data);
                    } catch (QueryException $e) {
                        if ($attempt >= 5 || ! str_contains(strtolower($e->getMessage()), 'no_pendaftaran')) {
                            throw $e;
                        }
                        usleep(50000 * $attempt);
                    }
                }
            });
        } catch (QueryException $e) {
            $msg = strtolower($e->getMessage());
            if (str_contains($msg, 'no_pendaftaran')) {
                throw $e;
            }
            if (str_contains($msg, 'nisn')) {
                return back()->withErrors(['nisn' => 'NIK atau NISN Anda sudah terdaftar, Mohon untuk diperiksa kembali'])->withInput();
            }
            if (str_contains($msg, 'nik')) {
                return back()->withErrors(['nik' => 'NIK atau NISN Anda sudah terdaftar, Mohon untuk diperiksa kembali'])->withInput();
            }
            throw $e;
        }

        session()->forget('ppdb_form');
        $request->session()->put('ppdb_last_no', $pendaftaran->no_pendaftaran);

        return redirect()->route('ppdb.sukses', $pendaftaran->no_pendaftaran);
    }

    public function sukses(Request $request, string $no)
    {
        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $no)->firstOrFail();

        if (! $this->bolehLihatDokumen($request, $no)) {
            return redirect()->route('ppdb.cek.form')
                ->withErrors(['no_pendaftaran' => 'Gunakan Cek Status dengan nomor + tanggal lahir untuk melihat data ini.']);
        }

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

    public function faq()
    {
        return view('ppdb.faq');
    }

    public function kartu(Request $request, string $no)
    {
        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $no)->firstOrFail();

        if (! $this->bolehLihatDokumen($request, $no)) {
            return redirect()->route('ppdb.cek.form')
                ->withErrors(['no_pendaftaran' => 'Gunakan Cek Status dengan nomor + tanggal lahir untuk melihat data ini.']);
        }

        return view('ppdb.kartu', compact('pendaftaran'));
    }

    public function kwitansi(Request $request, string $no)
    {
        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $no)->firstOrFail();

        if ($pendaftaran->status !== 'diterima') {
            return redirect()->route('ppdb.cek.form')
                ->withErrors(['no_pendaftaran' => 'Kwitansi tersedia setelah status DITERIMA. Cek status dahulu.']);
        }

        if (! $this->bolehLihatDokumen($request, $no)) {
            return redirect()->route('ppdb.cek.form')
                ->withErrors(['no_pendaftaran' => 'Sesi berakhir. Masukkan nomor + tanggal lahir di Cek Status dahulu.']);
        }

        return view('ppdb.kwitansi', compact('pendaftaran'));
    }

    private function bolehLihatDokumen(Request $request, string $no): bool
    {
        if ($request->session()->get('ppdb_last_no') === $no) {
            return true;
        }

        $user = Auth::user();
        if (! $user) {
            return false;
        }

        $allowed = array_filter(array_map('trim', explode(',', (string) env('PPDB_ADMIN_EMAILS', 'admin@smasantopaulus.sch.id'))));

        return in_array($user->email, $allowed, true);
    }

    public function cek(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string|max:30',
            'tanggal_lahir' => 'required|date|before:today',
        ]);

        $pendaftaran = PpdbRegistration::where('no_pendaftaran', $request->no_pendaftaran)
            ->whereDate('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        if (! $pendaftaran) {
            return back()->withErrors(['no_pendaftaran' => 'Data tidak ditemukan. Periksa nomor dan tanggal lahir.'])->withInput();
        }

        $request->session()->put('ppdb_last_no', $pendaftaran->no_pendaftaran);

        return view('ppdb.status', compact('pendaftaran'));
    }
}
