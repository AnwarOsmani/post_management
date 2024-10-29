<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\DeliveryRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        return view('users.admin.dashboard');
    }

    // Display requests related to admin’s province
    public function requests()
    {
        $admin = Auth::user()->admin;
        $postalCode = $admin->postal_code;
        $requests = DeliveryRequest::where('sender_postal_code', $postalCode)->get();
        return view('delivery.admin.index', compact('requests'));
    }

    public function showWorkers()
    {
        // Get the workers that are related to the logged-in admin
        $workers = Worker::where('admin_id', Auth::user()->admin->id)->with('user')->get();

        return view('users.admin.show-workers', compact('workers'));
    }
    public function createWorker()
    {
        return view('users.admin.create-worker');
    }

    // Store a new worker
    public function storeWorker(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user part (parent)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 3,
        ]);

        // Create the worker part (child)
        $currentAdmin = Auth::user()->admin; // Assuming the admin is logged in
        Worker::create([
            'user_id' => $user->id,
            'admin_id' => $currentAdmin->id,
            'postal_code' => $currentAdmin->postal_code,
        ]);

        // Redirect to a page that lists all workers related to the admin
        return redirect()->route('admin.worker.all')->with('success', 'Worker created successfully');
    }

    public function destroyWorker($id)
    {
        // Retrieve the worker based on admin relationship and worker ID
        $worker = Auth::user()->admin->workers()->where('id', $id)->first();
        // dd($worker);

        if (!$worker) {
            abort(404, 'Worker not found or does not belong to the current admin.');
        }

        // Delete the worker
        $worker->user->delete();

        return redirect()->route('admin.worker.all')->with('success', 'Worker deleted successfully.');
    }


}
