<?php

namespace App\Http\Controllers;

use App\Models\PpdbRegistration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'nisn' => 'nullable|digits:10|unique:ppdb_registrations,nisn',
            'nik' => [
                'nullable',
                'digits:16',
                'unique:ppdb_registrations,nik',
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
                    if ($day !== (int) $date->format('d')
                        || $month !== (int) $date->format('m')
                        || $yy !== $date->format('y')) {
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
            'nama_ayah' => 'nullable|string|max:100',
            'pekerjaan_ayah' => 'nullable|string|max:50',
            'nama_ibu' => 'nullable|string|max:100',
            'pekerjaan_ibu' => 'nullable|string|max:50',
            'no_hp_ortu' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+\-\s]{9,20}$/'],
            'jalur' => 'required|in:reguler,prestasi,afirmasi',
            'gelombang' => 'required|in:1,2',
            'skema_bayar' => 'required|in:lunas,angsuran',
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

        $data['status'] = 'pending';

        try {
            $pendaftaran = DB::transaction(function () use ($data) {
                $attempt = 0;
                while (true) {
                    $attempt++;
                    try {
                        return PpdbRegistration::create(
                            $data + ['no_pendaftaran' => PpdbRegistration::generateNoPendaftaran()]
                        );
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
                return back()->withErrors(['nisn' => 'NISN ini sudah terdaftar. Gunakan Cek Status atau hubungi panitia.'])->withInput();
            }
            if (str_contains($msg, 'nik')) {
                return back()->withErrors(['nik' => 'NIK ini sudah terdaftar. Gunakan Cek Status atau hubungi panitia.'])->withInput();
            }
            throw $e;
        }

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

        if ($pendaftaran->status !== 'diterima' || ! $this->bolehLihatDokumen($request, $no)) {
            return redirect()->route('ppdb.cek.form')
                ->withErrors(['no_pendaftaran' => 'Kwitansi tersedia setelah status DITERIMA. Cek status dahulu.']);
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

        return view('ppdb.status', compact('pendaftaran'));
    }
}
