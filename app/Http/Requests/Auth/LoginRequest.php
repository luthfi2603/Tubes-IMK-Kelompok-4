<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'nomor_handphone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', 'regex:/\b08\d{9,11}\b/'],
            'password' => ['required', 'string'],
        ];
    }
    
    public function messages(): array {
        return [
            'nomor_handphone.required' => 'Kolom nomor handphone harus diisi.',
            'nomor_handphone.numeric' => 'Nomor handphone harus diisi dengan angka.',
            'nomor_handphone.min_digits' => 'Nomor handphone harus terdiri dari minimal :min digit.',
            'nomor_handphone.max_digits' => 'Nomor handphone harus terdiri dari maksimal :max digit.',
            'nomor_handphone.regex' => 'Nomor handphone tidak valid',
            'password.required' => 'Kolom password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal :min karakter.',
            'password.max' => 'Password tidak boleh melebihi :max karakter.',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('nomor_handphone', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nomor_handphone' => trans('Nomor handphone atau kata sandi tidak sesuai.'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}