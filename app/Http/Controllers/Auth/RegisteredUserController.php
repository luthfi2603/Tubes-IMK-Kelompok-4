<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Pasien;
use Twilio\Rest\Client;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller {
    public function create(): View {
        return view('register');
    }

    public function store(Request $request): RedirectResponse {
        $user = User::where('nomor_handphone', $request->nomor_handphone)->first();

        if($user !== NULL){ // kalau user nya ada
            if($user->password !== NULL){ // kalau password nya ada
                return back()->withInput()->with('failed', 'Registrasi gagal, nomor handphone sudah terdaftar');
            }
        }

        $messages = [
            'nama.required' => 'Kolom nama harus diisi.',
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
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
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/'],
            'alamat' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:P,L'],
            'tanggal_lahir' => ['required', 'date'],
            'pekerjaan' => ['required', 'string', 'max:255'],
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ], $messages);

        if(substr(trim($request->nomor_handphone), 0, 1) == '0'){
            $nomorHP = '+62'.substr(trim($request->nomor_handphone), 1);
        }

        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");
            
            $twilio = new Client($twilioSid, $token);
            $twilio->verify->v2->services($twilioVerifySid)
                ->verifications
                ->create($nomorHP, "sms");
        }catch(\Throwable $th){
            return back()->withInput()->with('failed', 'Registrasi gagal, tidak dapat mengirim kode OTP');
        } */

        $request = $request->all();
        $request['nomor_handphone_dimodifikasi'] = $nomorHP;

        session()->put('request', $request);

        return redirect(route('verifikasi'))->with('success', 'Berhasil, Kode OTP sudah dikirim ke nomor handphone anda, silahkan masukkan kode OTP yang diterima');
    }

    public function createVerifikasi(){
        if(session()->get('request') == null){
            return redirect(route('register'));
        }

        return view('verifikasi');
    }

    public function storeVerifikasi(Request $request){
        $messages = [
            'kode_verifikasi.required' => 'Silahkan masukkan kode OTP.',
            'kode_verifikasi.numeric' => 'Kode OTP yang dimasukkan harus berupa angka.',
            'kode_verifikasi.digits' => 'Kode OTP harus terdiri dari :digits digit.',
            'nomor_handphone.required' => 'Silahkan masukkan nomor handphone.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
        ];

        $validator = Validator::make($request->all(), [
            'kode_verifikasi' => ['required', 'numeric', 'digits:6'],
            'nomor_handphone' => ['required', 'string'],
        ], $messages);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        if($request->kode_verifikasi != '123456'){
            // return back()->with('failed', 'Kode OTP salah!');
            return response()->json(['failed' => 'Kode OTP Salah']);
        }

        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($twilioSid, $token);
            $verification = $twilio->verify->v2->services($twilioVerifySid)
                ->verificationChecks
                ->create(['code' => $request->kode_verifikasi, 'to' => $request->nomor_handphone]);
        }catch(\Throwable $th){
            return back()->with('failed', 'Durasi kode OTP sudah habis!');
        } */

        $request0 = session()->get('request');
        
        $user = User::where('nomor_handphone', $request0['nomor_handphone'])->first();

        // if($verification->valid){
            if($user === NULL){
                // kalau gak ada
                User::create([
                    'nomor_handphone' => $request0['nomor_handphone'],
                    'password' => bcrypt($request0['password']),
                    'status' => 'pasien',
                ]);
    
                Pasien::create([
                    'nama' => $request0['nama'],
                    'alamat' => $request0['alamat'],
                    'jenis_kelamin' => $request0['jenis_kelamin'],
                    'tanggal_lahir' => $request0['tanggal_lahir'],
                    'pekerjaan' => $request0['pekerjaan'],
                    'id_user' => User::latest()->first()->id
                ]);
            }else{
                // kalau ada
                $user->update([
                    'password' => bcrypt($request0['password'])
                ]);
            }

            session()->forget('request');
    
            // return redirect(route('login'))->with('success', 'Akun berhasil dibuat, silahkan login');
            return response()->json(['success' => 'Akun berhasil dibuat, silahkan login']);
        /* }else{
            return back()->with('failed', 'Kode OTP salah!');
        } */
    }

    public function storeKirimUlangKodeOtp(){
        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($twilioSid, $token);
            $twilio->verify->v2->services($twilioVerifySid)
                ->verifications
                ->create(session()->get('request')['nomor_handphone_dimodifikasi'], "sms");
        }catch(\Throwable $th){
            return back()->with('failed', 'Registrasi gagal, tidak dapat mengirim kode OTP');
        } */

        // return back()->with('success', 'Berhasil, Kode OTP sudah dikirim ulang ke nomor handphone anda, silahkan masukkan kode OTP yang diterima');
        return response()->json(['success' => 'Berhasil, Kode OTP sudah dikirim ulang ke nomor handphone anda, silahkan masukkan kode OTP yang diterima']);
    }

    public function createVerifikasiNomorHandphone(){
        return view('verifikasi-nomor-handphone');
    }

    public function storeVerifikasiNomorHandphone(Request $request){
        $messages = [
            'nomor_handphone.required' => 'Silahkan masukkan nomor handphone.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
        ];

        $request->validate([
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/']
        ], $messages);

        $user = User::where('nomor_handphone', $request->nomor_handphone)->first();

        if($user !== NULL){ // kalau user nya ada
            if(substr(trim($request->nomor_handphone), 0, 1) == '0'){
                $nomorHP = '+62'.substr(trim($request->nomor_handphone), 1);
            }
    
            /* try {
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilioSid = getenv("TWILIO_SID");
                $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

                $twilio = new Client($twilioSid, $token);
                $twilio->verify->v2->services($twilioVerifySid)
                    ->verifications
                    ->create($nomorHP, "sms");
            }catch(\Throwable $th){
                return back()->withInput()->with('failed', 'Registrasi gagal, tidak dapat mengirim kode OTP');
            } */
        }else{
            return back()->with('failed', 'Nomor handphone tidak terdaftar');
        }

        $request0 = [];
        $request0['nomor_handphone_dimodifikasi'] = $nomorHP;
        $request0['nomor_handphone'] = $request->nomor_handphone;

        session()->put('request', $request0);

        return redirect(route('verifikasi.otp.reset.password'))->with('success', 'Berhasil, Kode OTP sudah dikirim ke nomor handphone anda, silahkan masukkan kode OTP yang diterima');
    }
    
    public function createVerifikasiOtpResetPassword(){
        if(session()->get('request') == null){
            return redirect(route('verifikasi.nomor.handphone'))->with('failed', 'Silahkan verifikasi nomor handphone anda terlebih dahulu');
        }

        return view('verifikasi-otp-reset-password');
    }

    public function storeVerifikasiOtpResetPassword(Request $request){
        $messages = [
            'kode_verifikasi.required' => 'Silahkan masukkan kode OTP.',
            'kode_verifikasi.numeric' => 'Kode OTP yang dimasukkan harus berupa angka.',
            'kode_verifikasi.digits' => 'Kode OTP harus terdiri dari :digits digit.',
            'nomor_handphone.required' => 'Silahkan masukkan nomor handphone.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
        ];

        $validator = Validator::make($request->all(), [
            'kode_verifikasi' => ['required', 'numeric', 'digits:6'],
            'nomor_handphone' => ['required', 'string'],
        ], $messages);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()]);
        }

        if($request->kode_verifikasi != '123456'){
            // return back()->with('failed', 'Kode OTP salah!');
            return response()->json(['failed' => 'Kode OTP Salah']);
        }

        /* try {
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilioSid = getenv("TWILIO_SID");
            $twilioVerifySid = getenv("TWILIO_VERIFY_SID");

            $twilio = new Client($twilioSid, $token);
            $verification = $twilio->verify->v2->services($twilioVerifySid)
                ->verificationChecks
                ->create(['code' => $request->kode_verifikasi, 'to' => $request->nomor_handphone]);
        }catch(\Throwable $th){
            return back()->with('failed', 'Durasi kode OTP sudah habis!');
        } */

        // if($verification->valid){
            $request0 = session()->get('request');
            $request0['terverifikasi'] = true;
            session()->put('request', $request0);

            // return redirect(route('reset.password'))->with('success', 'Verifikasi OTP berhasil, silahkan reset password anda');
            return response()->json(['success' => 'Verifikasi OTP berhasil, silahkan reset password anda']);
        /* }else{
            return back()->with('failed', 'Kode OTP salah!');
            return response()->json(['failed' => 'Kode OTP Salah']);
        } */
    }

    public function createResetPassword(){
        if(session()->get('request') == null){ // kalau ga ada
            return redirect(route('verifikasi.nomor.handphone'))->with('failed', 'Silahkan verifikasi nomor handphone anda terlebih dahulu');
        }else{ // kalau ada
            if(!isset(session()->get('request')['terverifikasi'])){ // kalo ga ada key terverifikasi
                return redirect(route('verifikasi.otp.reset.password'))->with('failed', 'Silahkan verifikasi kode OTP terlebih dahulu');
            }
        }

        return view('reset-password');
    }
    
    public function storeResetPassword(Request $request){
        $messages = [
            'konfirmasi_password.required' => 'Kolom konfirmasi password harus diisi.',
            'konfirmasi_password.same' => 'Konfirmasi password dan password harus sama.',
            'konfirmasi_password.min' => 'Konfirmasi password harus terdiri dari minimal :min karakter.',
            'konfirmasi_password.max' => 'Konfirmasi password tidak boleh melebihi :max karakter.'
        ];

        $request->validate([
            'password' => ['required', 'same:konfirmasi_password', 'min:8', 'max:255'],
            'konfirmasi_password' => ['required', 'same:password', 'min:8', 'max:255']
        ], $messages);

        $user = User::where('nomor_handphone', session()->get('request')['nomor_handphone'])->first();

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        session()->forget('request');

        return redirect(route('login'))->with('success', 'Password berhasil direset');
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