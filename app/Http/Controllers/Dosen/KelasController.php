<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Crypt};
use App\Models\{Absen, Jadwal, Materi, Mahasiswa};

class KelasController extends Controller
{

    public function masuk($jadwalId)
    {
        //parameter $jadwalId adalah id dari jadwal yang sudah di encrypt
        //dan kode dibawah untuk mencari jadwal dari param $jadwalId sekalian di decrypt var $jadwalId nya
        $jadwal = Jadwal::where('id', decrypt($jadwalId))->first();

        // Jika waktu pada jadwal sesuai maka jalankan code dibawah
        if (waktuSekarang() >= $jadwal->jam_masuk && waktuSekarang() <= $jadwal->jam_keluar) {

            // Code dibawah untuk menampilkan seluruh mahasiswa yang berada di kelas yang sama dan dijadwal yang sama
            // Beserta menampilkan  absensi hari ini
            $mahasiswa = Mahasiswa::with(['mahasiswaAbsenHariIni' => function ($q) use ($jadwal) {
                $q->where('jadwal_id', $jadwal->id);
            }])->where('kelas_id', $jadwal->kelas_id)->get();

            $mahasiswaHadir = $mahasiswa->where('mahasiswaAbsenHariIni', '!=', null)->count();
            $mahasiswaTidakHadir = $mahasiswa->where('mahasiswaAbsenHariIni', '==', null)->count();

            // Code dibawah untuk menampilkan data absen yang telah dibuat oleh dosen untuk hari ini
            // dan akan digunakan untuk simpan rekap absen
            $absen = Absen::where('dosen_id', Auth::Id())
                ->where('jadwal_id', $jadwal->id)
                ->whereDate('created_at', now())
                ->first();


            return view('frontend.dosen.kelas.masuk', compact('mahasiswa', 'jadwal', 'absen', 'mahasiswaHadir', 'mahasiswaTidakHadir'));
        }

        // Jika waktu pada jadwal tidak sesuai return back
        return back();
    }

    public function storeAbsen()
    {
        $absen = collect(Absen::where('dosen_id', Auth::Id())
            ->where('jadwal_id', request('jadwal'))
            ->whereDate('created_at', date('Y-m-d'))
            ->first());

        //Jika parent absen belom dibuat jangan kasih create absen
        if ($absen->isNotEmpty()) {
            for ($i = 0; $i < count(request('mahasiswa')); $i++) {
                Absen::updateOrCreate(
                    [
                        'mahasiswa_id' => request('mahasiswa')[$i],
                        'parent' => $absen['id']
                    ],
                    [
                        'parent' => request('parent'),
                        'status' => request('status')[$i],
                        'jadwal_id' => request('jadwal'),
                        'pertemuan' => request('pertemuan'),
                    ]
                );
            }
            return back()->with('success', 'Berhasil menyimpan data absen');
        }

        return back()->with('error', 'Ups!! Sepertinya anda belum membuat absen untuk hari ini');
    }

    public function materi($jadwalId)
    {

        // return Mahasiswa::get();
        //Setelah di decrypt cari. apakah id ada di dalam table jadwal
        //jika ada tampilkan hanya 1
        $jadwal = Jadwal::where('id', decrypt($jadwalId))->firstOrFail();
        $materis = Materi::with(['matkul', 'kelas'])
            ->where('matkul_id', $jadwal->matkul_id)
            ->where('dosen_id', $jadwal->dosen_id)
            ->where('kelas_id', $jadwal->kelas_id)
            ->latest()->get();

        return view('frontend.dosen.kelas.materi', compact('materis', 'jadwal'));
    }
}
