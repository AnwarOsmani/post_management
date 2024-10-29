<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminWorkerLoginRequest;
use App\Http\Requests\Auth\EmployeeLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class EmployeeAuthenticatedSessionController extends Controller
{
    /**
     * Display the login view for admins and workers.
     */
    public function create(): View
    {
        return view('auth.employee-login');
    }

    /**
     * Handle an incoming authentication request for admins and workers.
     */
    public function store(EmployeeLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Redirect based on the user role (admin or worker)
        if ($user->role == 2) {
            return redirect()->intended(route('admin.dashboard')); // Redirect to admin dashboard
        } elseif ($user->role == 3) {
            return redirect()->intended(route('worker.dashboard')); // Redirect to worker dashboard
        }

        return redirect('/');
    }



    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin-worker-login'); // Redirect to admin/worker login page
    }
}
