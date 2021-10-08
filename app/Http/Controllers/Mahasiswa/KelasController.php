<?php

namespace App\Http\Controllers\Mahasiswa;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\{Absen, Jadwal, Materi};
use Illuminate\Support\Facades\{Auth, Crypt};

class KelasController extends Controller
{
    public function waktuSekarang()
    {
        return Carbon::now('Asia/Jakarta')->format('H:i');
    }

    public function masuk($id)
    {
        $jadwal_id = Crypt::decryptString($id);
        $jadwal = Jadwal::whereId($jadwal_id)->first();

        $absens = Auth::user()->absens()->whereJadwalId($jadwal_id)->paginate(5);


        //Untuk membatasi waktu absen misal : jam masuk 12:00 sedangkan waktu saat itu belum jam 12:00 
        //Jadi tidak bisa absen kalau belum waktu nya dan juga berlaku untuk jam keluar, jika lebih dari waktu
        //Jam Keluar ya sudah tidak bisa absen lagi
        if (hariIndo() == $jadwal->hari) {
            $waktuAbsen = $this->waktuSekarang() >= $jadwal->jam_masuk && $this->waktuSekarang() <= $jadwal->jam_keluar;
        } else {
            $waktuAbsen = false;
        }

        //Nyambung sama kode diatas.. jadi kode dibawah untuk mengizinkan mahasiswa melakukan absen jika
        //Absen sudah dibuat oleh dosen, jika waktu jam masuk sudah lebih dari jam 12:00 tapi dosen belum
        //Buat absen nya maka mahasiswa nya juga belum bisa absen
        $allowMhsAbsen = Absen::where('jadwal_id', $jadwal_id)->where('parent', 0)->first();

        return view('frontend.mahasiswa.kelas.masuk', compact('jadwal', 'absens', 'waktuAbsen', 'allowMhsAbsen'));
    }

    public function absen()
    {
        // return request()->all();
        $jadwal_id = Crypt::decryptString(request('jadwal'));
        // $jadwal = Jadwal::findOrFail($jadwal_id);
        $absen = Absen::where('jadwal_id', $jadwal_id)->where('parent', 0)->whereDate('created_at', date('Y-m-d'))->first();

        //Jika Mahasiswa yang login sudah absen pada waktu yang ditentukan jangan kasih absen lagi
        //Jika belum izinkan absen
        if (!Auth::user()->userAbsen) {
            Absen::updateOrCreate([
                'mahasiswa_id' => Auth::Id()
            ],[
                'jadwal_id' => $jadwal_id,
                'pertemuan' => $absen->pertemuan,
                'parent' => $absen->id,
                'status' => true,
            ]);
        }
        // if (!Auth::user()->userAbsen) {
        //     Auth::user()->absens()->create([
        //         'jadwal_id' => $jadwal_id,
        //         'pertemuan' => $absen->pertemuan,
        //         'parent' => $absen->id,
        //         'status' => true,
        //     ]);
        // }

        return back();
    }

    public function materi($id)
    {
        //Decrypt var $id dari jadwal
        $jadwal_id =  Crypt::decryptString($id);

        //Setelah di decrypt cari. apakah id ada di dalam table jadwal
        //jika ada tampilkan hanya 1
        $jadwal = Jadwal::whereId($jadwal_id)->first();
        $materis = Materi::whereMatkulId($jadwal->matkul_id)->whereDosenId($jadwal->dosen_id)->whereKelasId($jadwal->kelas_id)->latest()->paginate(5);

        if (Auth::guard('mahasiswa')->user()->kelas_id == $jadwal->kelas_id) {
            //Jika mahasiswa yang login kelas_id sama dengan kelas_id yang ada di jadwal return ke suatu halaman
            return view('frontend.mahasiswa.kelas.materi', compact('materis', 'jadwal'));
        }
        //Jika tidak sama return ke 404
        abort(404);
    }
}
