<?php

namespace App\Http\Controllers\Mahasiswa;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\{Absen, Jadwal, Materi, Tugas};

class KelasController extends Controller
{
    public function waktuSekarang()
    {
        return Carbon::now('Asia/Jakarta')->format('H:i');
    }

    public function masuk($id)
    {
        $jadwal_id = decrypt($id);
        $jadwal = Jadwal::where('id', $jadwal_id)->first();

        $absens = Auth::user()->absens()->where('jadwal_id', $jadwal_id)->paginate(5);

        $test = collect([
            ['jadwal_id' => 2, 'nama' => 'fadlie'],
            ['jadwal_id' => 3, 'nama' => 'udin']
        ]);

        //Untuk membatasi waktu absen misal : jam masuk 12:00 sedangkan waktu saat itu belum jam 12:00 
        //Jadi tidak bisa absen kalau belum waktu nya dan juga berlaku untuk jam keluar, jika lebih dari waktu
        //Jam Keluar ya sudah tidak bisa absen lagi
        if (hariIndo() == $jadwal->hari) {
            $waktuAbsen = $this->waktuSekarang() >= $jadwal->jam_masuk && $this->waktuSekarang() <= $jadwal->jam_keluar;
        } else {
            $waktuAbsen = false;
        }

        $allowMhsAbsen = Absen::where('jadwal_id', $jadwal_id)->where('parent', 0)->whereDate('created_at', now())->first();
        $isAbsen = Auth::user()->isAbsen($jadwal_id)->first();

        return view('frontend.mahasiswa.kelas.masuk', compact('jadwal', 'absens', 'waktuAbsen', 'allowMhsAbsen', 'isAbsen'));
    }

    public function absen()
    {
        $jadwal_id = decrypt(request('jadwal'));
        $absen = Absen::where('jadwal_id', $jadwal_id)->where('parent', 0)->latest()->first();
        $isAbsen = Auth::user()->isAbsen($jadwal_id)->first();


        //Jika Mahasiswa yang login sudah absen pada waktu yang ditentukan jangan kasih absen lagi
        if (!$isAbsen) {
            //Jika belum izinkan absen
            Absen::updateOrCreate([
                'mahasiswa_id' => Auth::Id(),
                'parent' => $absen->id
            ], [
                'jadwal_id' => $jadwal_id,
                'pertemuan' => $absen->pertemuan,
                'parent' => $absen->id,
                'status' => true,
            ]);
        }

        return back();
    }

    public function materi($id)
    {
        //Decrypt var $id dari jadwal
        $jadwal_id =  decrypt($id);

        //Setelah di decrypt cari. apakah id ada di dalam table jadwal
        //jika ada tampilkan hanya 1
        $jadwal = Jadwal::whereId($jadwal_id)->first();
        $materis = Materi::where('matkul_id', $jadwal->matkul_id)
            ->where('dosen_id', $jadwal->dosen_id)
            ->where('kelas_id', $jadwal->kelas_id)
            ->latest()->get();

        if (Auth::guard('mahasiswa')->user()->kelas_id != $jadwal->kelas_id) {
            //Jika mahasiswa yang login kelas_id tidak sama dengan kelas_id yang ada di jadwal return ke 404
            abort(404);
        }

        return view('frontend.mahasiswa.kelas.materi', compact('materis', 'jadwal'));
    }

    public function tugas($jadwalId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->first();

        $tugas = Tugas::whereJadwalId($jadwal->id)->whereParent(0)->latest()->paginate(10);
        $tugasHasBeenSent = Auth::user()->tugas()->whereJadwalId($jadwal->id)->paginate(10);
        
        return view('frontend.mahasiswa.kelas.tugas.index', compact('jadwal', 'tugas', 'tugasHasBeenSent'));
    }

    public function sendTugas($jadwalId, $tugasId)
    {
        $jadwal = Jadwal::whereId(decrypt($jadwalId))->firstOrFail();
        $tugas = Tugas::whereId($tugasId)->firstOrFail();

        // kondisi jika tugas pengumpulan sudah lebih dari batas waktu
        if ($tugas->pengumpulan < date('Y-m-d H:i:s')) {
            return back()->with('error', 'Batas waktu pengumpulan tugas sudah lebih dari batas waktu');
        }

        return view('frontend.mahasiswa.kelas.tugas.kirim_tugas', compact('jadwal', 'tugas'));
    }

    public function store($jadwalId, $tugasId)
    {
        request()->validate([
            'link' => 'required',
        ]);

        $jadwal = Jadwal::whereId(decrypt($jadwalId))->firstOrFail();
        $tugas = Tugas::whereId($tugasId)->firstOrFail();
        if ($tugas->pengumpulan > date('Y-m-d H:i:s')) {
            Auth::user()->tugas()->updateOrCreate(
                [
                    'mahasiswa_id' => Auth::id(),
                    'parent' => $tugas->id
                ],
                [
                    'jadwal_id' => $jadwal->id,
                    'matkul_id' => $jadwal->matkul_id,
                    'judul' => $tugas->judul,
                    'parent' => $tugas->id,
                    'tipe' => 'link',
                    'file_or_link' => request('link'),
                    'pertemuan' => $tugas->pertemuan,
                    'pengumpulan' => $tugas->pengumpulan,
                ]
            );

            session()->flash('success', 'Tugas berhasil dikirim');
            return redirect()->route('tugas.mhs', encrypt($jadwal->id));
        }


        session()->flash('error', 'Batas waktu pengumpulan tugas sudah lebih dari batas waktu');
        return redirect()->route('tugas.mhs', encrypt($jadwal->id));
    }
}
