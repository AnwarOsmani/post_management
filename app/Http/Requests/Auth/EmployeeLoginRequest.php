<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class EmployeeLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'postal_code' => ['required', 'digits:6', 'exists:postal_codes,postal_code'], // Ensure postal_code exists
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Attempt login using email and password
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // Additional check for role and postal_code
        $user = Auth::user();

        // Check if the user is an admin or worker
        if (!in_array($user->role, [2, 3])) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => __('You are not allowed to log in through this portal.'),
            ]);
        }

        // Check the postal_code for admin or worker
        if ($user->role == 2) {
            // Check the postal_code from the related admin record
            if (!$user->admin || $user->admin->postal_code !== $this->input('postal_code')) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'postal_code' => __('Postal code mismatch.'),
                ]);
            }
        } elseif ($user->role == 3) {
            // Check the postal code from the related worker record
            if (!$user->worker || $user->worker->postal_code !== $this->input('postal_code')) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'postal_code' => __('Postal code mismatch.'),
                ]);
            }
        }

        RateLimiter::clear($this->throttleKey());
    }


    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
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
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
