<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ForgotPassword;

class ForgotPasswordController extends Controller
{
    public function showPageForgotPassword()
    {
        return view('auth.passwords.email');
    }

    public function sendEmail()
    {
        $mahasiswa = Mahasiswa::whereEmail(request('email'))->first();
        $dosen = Dosen::whereEmail(request('email'))->first();

        $token = Str::random(60);
        if ($mahasiswa) {
            if($mahasiswa->email == 'mahasiswa@gmail.com'){
                return back()->with('error', 'Tidak bisa mengirim email ke akun demo');
            }
            $mahasiswa->notify(new ForgotPassword($token));
        } else if ($dosen) {
            if($dosen->email == 'dosen@gmail.com'){
                return back()->with('error', 'Tidak bisa mengirim email ke akun demo');
            }
            $dosen->notify(new ForgotPassword($token));
        } else {
            return back()->with('error', 'Email yang anda masukan tidak ditemukan');
        }
        DB::table('password_resets')->insert([
            'email' => request('email'),
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        // kirim url riset token langsung menggunakan session ini sebagain alternatif penggati kirim email
        // session()->flash('token', url("/riset-password?token=$token"));
        return back()->with('success', 'Link sudah dikirim, Silahkan cek email anda.');
    }

    public function showPageRisetPassword()
    {
        $userToken = DB::table('password_resets')->where('token', request('token'))->first();
        if ($userToken) {
            return view('auth.passwords.reset', compact('userToken'));
        }

        return abort(404);
    }

    public function updatePassword()
    {
        request()->validate([
            'password' => 'required|confirmed',
        ]);
        $userToken = DB::table('password_resets')->where('token', request('token'))->first();
        $mahasiswa = Mahasiswa::whereEmail($userToken->email)->first();
        $dosen = Dosen::whereEmail($userToken->email)->first();
        if ($userToken) {
            if ($mahasiswa) {
                $mahasiswa->password = bcrypt(request('password'));
                $mahasiswa->save();
            } else {
                $dosen->password = bcrypt(request('password'));
                $dosen->save();
            }
            DB::table('password_resets')->where('token', request('token'))->delete();
            return redirect('/login')->with('success', 'Password berhasil diubah.');
        }
        return abort(404);
    }
}
