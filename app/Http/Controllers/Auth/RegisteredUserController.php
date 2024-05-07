<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Symfony\Component\Mailer\Transport\Dsn;

class RegisteredUserController extends Controller {
    /**
     * Display the registration view.
     */
    public function create(): View {
        return view('register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse {
        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'alamat.required' => 'Kolom alamat harus diisi.',
            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak sesuai.',
            'tanggal_lahir.required' => 'Kolom tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'pekerjaan.required' => 'Kolom pekerjaan harus diisi.',
            'password.required' => 'Kolom password harus diisi.',
            'password.same' => 'Password dan konfirmasi password harus sama.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
            'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
            'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
            'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
            'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.'
        ];

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'tanggal_lahir' => ['required', 'date'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ], $messages);

        if(User::select('nomor_handphone')->where('nomor_handphone', $request->nomor_handphone)->get()->isEmpty()){
            // kalau gak ada
            User::create([
                'nomor_handphone' => $request->nomor_handphone,
                'password' => bcrypt($request->password),
                'status' => 'pasien',
            ]);

            Pasien::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pekerjaan' => $request->pekerjaan,
                'id_user' => User::latest()->first()->id
            ]);
        }else{
            // kalau ada
            User::where('nomor_handphone', $request->nomor_handphone)->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return redirect(route('login', absolute: true));
    }
    
    /**
     * Display the registration view.
     */
    public function create0(): View {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store0(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}